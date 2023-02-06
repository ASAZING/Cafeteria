<?php 

class Product {

	private $table = 'products';
	private $conection;

	public function __construct() {
		
	}

	/* Conexion */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Obtener todos los productos */
	public function getProducts(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Obtener producto por id */
	public function getProductById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	/* Guardar Producto */
	public function save($param){
		$this->getConection();

		/* Se inicializa variables */
		$name = $reference = $category =  $created_at = "";
		$price = $stock = $weight = 0;


		/* valido si existe */
		$exists = false;
		if(isset($param["id"]) and $param["id"] !=''){
			$actualProduct = $this->getProductById($param["id"]);
			if(isset($actualProduct["id"])){
				$exists = true;	
				$id 		= $param["id"];
				$name 		= $actualProduct["name"];
				$stock 		=  $actualProduct["stock"];
				$price 		= $actualProduct["price"];
				$weight		= $actualProduct["weight"];
				$category 	=   $actualProduct["category"];
				$reference	= $actualProduct["reference"];
				$created_at =  $actualProduct["created_at"];
			}
		}

		if(isset($param["name"])) $name = $param["name"];
		if(isset($param["stock"])) $stock = $param["stock"];
		if(isset($param["weight"])) $weight = $param["weight"];
		if(isset($param["price"])) $price = $param["price"];
		if(isset($param["category"])) $category = $param["category"];
		if(isset($param["reference"])) $reference = $param["reference"];
		if(isset($param["created_at"])) $created_at = $param["created_at"];

		if($exists){
			$sql = "UPDATE ".$this->table. " SET name = ?, price = ?, weight = ?, category = ?, stock = ?, created_at = ?, reference = ? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([ $name, $price, $weight, $category, $stock,  $created_at, $reference, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (name, price, weight, category, stock, created_at, reference) values(?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$name, $price, $weight, $category, $stock,  $created_at, $reference]);
			$id = $this->conection->lastInsertId();
		}	

		return $id;	

	}

	/* Eliminar prodcto por id */
	public function deleteProductById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

}