<?php
$name = $reference = $category =  $created_at = $id = "";
$price = $stock = $weight = 0;

if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["name"])) $name = $dataToView["data"]["name"];
if(isset($dataToView["data"]["stock"])) $stock = $dataToView["data"]["stock"];
if(isset($dataToView["data"]["price"])) $price = $dataToView["data"]["price"];
if(isset($dataToView["data"]["weight"])) $weight = $dataToView["data"]["weight"];
if(isset($dataToView["data"]["category"])) $category = $dataToView["data"]["category"];
if(isset($dataToView["data"]["reference"])) $reference = $dataToView["data"]["reference"];
if(isset($dataToView["data"]["created_at"])) $created_at = $dataToView["data"]["created_at"];
if(isset($dataToView["data"]["errors"])) $errors  = $dataToView["data"]["errors"];


?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Operación realizada correctamente. <a href="index.php?controller=productController&action=list">Volver al listado</a>
		</div>
		<?php
	}
	?>
	<form class="form" action="index.php?controller=productController&action=save" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Producto <span class="text-danger">* <?php echo isset($_GET["errors"]['name']) ? $_GET["errors"]['name'] : '';?></span></label>
			<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Referencia <span class="text-danger">* <?php echo isset($_GET["errors"]['reference']) ? $_GET["errors"]['reference'] : '';?></span></label>
			<input class="form-control" type="text" name="reference" value="<?php echo $reference; ?>" />
		</div>
		</div>
        <div class="form-group mb-2">
			<label>Categoria <span class="text-danger">* <?php echo isset($_GET["errors"]['category']) ? $_GET["errors"]['category'] : '';?></span></label>
            <input class="form-control" type="text" name="category" value="<?php echo $category; ?>" />
		</div>
        <div class="form-group mb-2">
			<label>Stock <span class="text-danger">* <?php echo isset($_GET["errors"]['stock']) ? $_GET["errors"]['stock'] : '';?></span></label>
            <input class="form-control" type="number" name="stock" value="<?php echo $stock; ?>" />
		</div>
        <div class="form-group mb-2">
			<label>Presio <span class="text-danger">* <?php echo isset($_GET["errors"]['price']) ? $_GET["errors"]['price'] : '';?></span></label>
            <input required class="form-control" type="number" name="price" value="<?php echo $price; ?>" />
		</div>
        <div class="form-group mb-2">
			<label>Peso <span class="text-danger">* <?php echo isset($_GET["errors"]['weight']) ? $_GET["errors"]['weight'] : '';?></span></label>
            <input class="form-control" type="number" name="weight" value="<?php echo $weight; ?>" />
		</div>
        <div class="form-group mb-2">
			<label>Fecha de creacion <span class="text-danger">* <?php echo isset($_GET["errors"]['created_at']) ? $_GET["errors"]['created_at'] : '';?></span></label>
            <input class="form-control" type="datetime-local" id="created_at" name="created_at" value="<?php echo $created_at; ?>" >
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="index.php?controller=productController&action=list">Cancelar</a>
	</form>
</div>