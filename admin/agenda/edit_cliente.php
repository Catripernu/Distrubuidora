<?php
session_start();
include_once("./../../sql/config.php");
if(isset($_GET['edit']) && $_SESSION['loggedin']){
	$id_vendedor = $_SESSION['id'];
  	$id = $_GET['id'];
  	$user = $conexion->query("SELECT * FROM agenda WHERE id_agenda = $id AND id_vendedor = $id_vendedor")->fetch(PDO::FETCH_ASSOC);
?>
<div class="edit_cliente">
<h2>MODIFICAR DATOS</h2>
<h5><?=$user['nombre_agenda'].", ".$user['apellido_agenda']?></h5>
<form action="#" method="POST">
	<label for="nombre">Nombre:</label>
	<input type="text" id="nombre" name="nombre" value="<?=$user['nombre_agenda']?>"><br><br>
	<label for="apellido">Apellido:</label>
	<input type="text" id="apellido" name="apellido" value="<?=$user['apellido_agenda']?>"><br><br>
	<label for="telefono">Telefono:</label>
	<input type="text" id="telefono" name="telefono" value="<?=$user['telefono_agenda']?>"><br><br>
	<label for="direccion">Direccion:</label>
	<input type="text" id="direccion" name="direccion" value="<?=$user['direccion_agenda']?>"><br><br>
	<input type="hidden" name="id_agenda" value="<?=$id?>">
	<a href="#" class="btn_default btn_exit" onclick="document.getElementById('popup').style.display='none'">Cerrar</a>
	<input type="submit" class="btn_default btn_success" name="edit" value="Editar">
    </form>
</div>
<?php } else {
	header("Location: ./../../index.php");
} ?>