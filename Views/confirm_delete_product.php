<div class="row">
	<form class="form" action="index.php?controller=productcontroller&action=delete" method="POST">
		<input type="hidden" name="id" value="<?php echo $dataToView["data"]["id"]; ?>" />
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar este producto?:</b>
			<i><?php echo $dataToView["data"]["name"]; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="index.php?controller=productcontroller&action=list">Cancelar</a>
	</form>
</div>