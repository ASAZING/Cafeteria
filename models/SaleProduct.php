<?php 

class SaleProduct {

	private $table = 'sales_product';
	private $conection;

	public function __construct() {
		
	}

	/* Conexion */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Guardar venta */
	public function save($param){
		$this->getConection();

		/* Se inicializa variables */
		$product_id = $quantity = $value = '';

		if(isset($param["product_id"])) $product_id = $param["product_id"];
		if(isset($param["quantity"])) $quantity = $param["quantity"];
		if(isset($param["value"])) $value = $param["value"];
		
        $sql = "INSERT INTO ".$this->table. " (product_id, quantity, value) values(?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$product_id, $quantity, $value]);
        $id = $this->conection->lastInsertId();

		return $id;	

	}
}