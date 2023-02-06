<?php 

require_once 'Models/Product.php';
require_once 'Models/SaleProduct.php';

class StoreController{
	public $page_title;
	public $view;
	private $productObj;
    private $saleProduct;

	public function __construct() {
		$this->view = 'sale_product';
		$this->page_title = '';
		$this->productObj = new Product();
        $this->saleProduct = new SaleProduct();
	}

	/* Crear o actualizar un producto */
	public function save(){
		$this->view = 'sale_product';
		$this->page_title = 'Tienda de producto';
		$result = null;
		$validate = $this->validateStock($_POST);
        if($validate["errors"]){
			$_GET["response"] = false;
			$_GET["errors"] = $validate["errors"];
		}else{
			$id = $this->saleProduct->save($validate);
			if($id){
                $_GET["response"] = true;
			    $_GET["errors"] = null;
                $this->productObj->updateStockById($validate['product_id'], $validate['new_stock']);
            }else
                $_GET["response"] = false;
                $_GET["errors"] = null;
            
		}
		
		return $result;
	}

	public function validateStock($data){
        $errors = null;
		$result = $this->productObj->getProductById($data['product_id']);
        if(isset($result["id"])){
            if($result["stock"] < 1 || $result["stock"] < $data['quantity'])
                $errors['quantity'] = 'No hay suficiente stock para esta compra';
            else{
                if($data['quantity'] < 1)
                    $errors['quantity'] = 'La cantidad debe se mayor a 0';
                else{
                    $data["value"] = $data['quantity'] * $result["price"];
                    $data["new_stock"] = $result["stock"] - $data['quantity'];
                }
                    
            } 
        }else{
            $errors['product_id'] = 'No se encontro producto con el id'.$data['product_id'];
        }

        $data['errors'] = $errors;
           
		return $data;
	}

}