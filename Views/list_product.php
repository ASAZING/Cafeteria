<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=productcontroller&action=edit" class="btn btn-outline-primary">Crear Producto</a>
		<hr/>
	</div>
	<?php
	if(count($dataToView["data"])>0){
		foreach($dataToView["data"] as $product){
			?>
			<div class="col-md-3">
				<div class="card-body border border-secondary rounded">
					<h5 class="card-title"><?php echo $product['name']; ?></h5>
					<div class="card-text">Id : <?php echo nl2br($product['id']); ?></div>
					<div class="card-text">Categoria : <?php echo nl2br($product['category']); ?></div>
					<div class="card-text">Presio : $<?php echo nl2br($product['price']); ?></div>
					<div class="card-text">Stock : <?php echo nl2br($product['stock']); ?></div>
					<hr class="mt-1"/>
					<a href="index.php?controller=productcontroller&action=edit&id=<?php echo $product['id']; ?>" class="btn btn-primary">Editar</a>
					<a href="index.php?controller=productcontroller&action=confirmDelete&id=<?php echo $product['id']; ?>" class="btn btn-danger">Eliminar</a>
				</div>
			</div>
			<?php
		}
	}else{
		?>
		<div class="alert alert-info">
			Actualmente no existen productos.
		</div>
		<?php
	}
	?>
</div>