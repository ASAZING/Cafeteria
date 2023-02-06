<?php 

require_once 'Models/product.php';

class ProductController{
	public $page_title;
	public $view;
	private $productObj;

	public function __construct() {
		$this->view = 'list_product';
		$this->page_title = '';
		$this->productObj = new Product();
	}

	/* Listar todos los prodcutos */
	public function list(){
		$this->page_title = 'Listado de productos';
		return $this->productObj->getProducts();
	}

	/* Cargar productos para editar */
	public function edit($id = null){
		$this->page_title = 'Editar producto';
		$this->view = 'edit_product';
		if(isset($_GET["id"])) $id = $_GET["id"];
			return $this->productObj->getProductById($id);
	}

	/* Crear o actulizar un producto */
	public function save(){
		$this->view = 'edit_product';
		$this->page_title = 'Editar producto';
		$result = null;
		$errors = $this->validateForm($_POST);
		if($errors){
			$_GET["response"] = false;
			$_GET["errors"] = $errors;
		}else{
			$id = $this->productObj->save($_POST);
			$result = $this->productObj->getProductById($id);
			$_GET["response"] = true;
			$_GET["errors"] = null;
		}
		
		return $result;
	}

	public function validateForm($form){
		$errors = [];
		if(empty($form["name"]) || !trim($form["name"]))  $errors['name'] = 'El nombre del producto es requerido';
		if(empty($form["stock"]) || !trim($form["stock"]))   $errors['stock'] = 'La cantidad del stock del producto es requerida';
		if(empty($form["weight"]) || !trim($form["weight"]))  $errors['weight'] = 'El peso del producto es requerido';
		if(empty($form["price"]) || !trim($form["price"]))  $errors['price'] = 'El precio del producto es requerido';
		if(empty($form["category"]) || !trim($form["category"]))  $errors['category'] = 'La categoria del producto es requerida';
		if(empty($form["reference"]) || !trim($form["reference"]))  $errors['reference'] = 'La referencia del producto es requerida';
		if(empty($form["created_at"]) || !trim($form["created_at"]))  $errors['created_at'] = 'La fecha de creacion del producto es requerida';
		return $errors;
	}

	/* Confirmación de eliminar */
	public function confirmDelete(){
		$this->page_title = 'Eliminar producto';
		$this->view = 'confirm_delete_product';
		return $this->productObj->getProductById($_GET["id"]);
	}

	/* Eliminar */
	public function delete(){
		$this->page_title = 'Listado de productos';
		$this->view = 'delete_product';
		return $this->productObj->deleteProductById($_POST["id"]);
	}

}