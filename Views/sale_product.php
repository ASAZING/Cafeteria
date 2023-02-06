<div class="row">
    <?php
        if(isset($_GET["response"]) and $_GET["response"] === true){
            ?>
            <div class="alert alert-success">
                Operación realizada correctamente. <a href="index.php?controller=productController&action=list">Volver al listado de productos</a>
            </div>
            <?php
        }
    ?> 
	<form class="form" action="index.php?controller=StoreController&action=save" method="POST">
		<div class="form-group">
			<label>Producto id <span class="text-danger">* <?php echo isset($_GET["errors"]['product_id']) ? $_GET["errors"]['product_id'] : '';?></span></label>
			<input class="form-control" type="number" name="product_id" value="<?php echo $name; ?>" />
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Cantidad <span class="text-danger">* <?php echo isset($_GET["errors"]['quantity']) ? $_GET["errors"]['quantity'] : '';?></span></label>
			<input class="form-control" type="number" name="quantity" value="<?php echo $name; ?>" />
		</div>
		<input type="submit" value="Comprar" class="btn btn-danger mt-2"/>
		<a class="btn btn-outline-success mt-2" href="index.php?controller=productController&action=list">Cancelar</a>
	</form>
</div>