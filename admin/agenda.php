<?php include("../php/includes_user.php");
include_once("../php/functions_agenda.php");
if(isset($_SESSION['loggedin']) && ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1)){
	$id = $_SESSION['id'];
	$link_buscador = "";
	if(isset($_GET['cliente'])){
		if(!empty($_GET['cliente'])){
			$cliente = $_GET['cliente'];
			$buscador = "AND (nombre_agenda LIKE '%$cliente%' OR apellido_agenda LIKE '%$cliente%') ORDER BY id_agenda DESC";
			$link_buscador = "?cliente=$cliente";
		} else {
			header("Location:agenda.php");
		}	
	}
	if($_POST['add_cliente']){
		$msj_opc = add_cliente($id);
		header("refresh: 3;");
	}
	if($_POST['edit']){
		$msj_opc = edit();
		header("refresh: 3;");
	}

	?>
<body>
<div id="contenido">
    <?php 
	$consulta_agenda = $conexion->query("SELECT * FROM agenda WHERE id_vendedor = $id");
	$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

	echo (isset($msj_opc)) ? $msj_opc : "";
	?>
	<div class='filtro_fecha'>
		<div>
			<form action="#" method="get">
				<input class="input_buscar" type="text" name="cliente" placeholder="Cliente a buscar..">
			</form>
		</div>
		<div class="btn_opciones">
			<a href='#' class='btn_planilla' onclick='actionAgenda(false,"add")' title='ADD CLIENTE'><i class='fa fa-user-plus fa-lg fa-fw'></i></a>
			<a href='../ticket/vendedor.php<?=$link_buscador?>' class='btn_planilla' title='EXPORTAR PDF'><i class='fa fa-print fa-lg fa-fw'></i></a>
      		<a href='../ticket/excel.php<?=$link_buscador?>' class='btn_planilla' title='EXPORTAR EXCEL'><i class='fa fa-file-excel fa-lg fa-fw'></i></a>
    	</div>
	</div>

	<?php if($consulta_agenda->rowCount()){
		$res = resultados_paginacion($agenda_resultados_por_pagina, $pagina, "agenda", (($buscador) ? "id_vendedor = '$id' $buscador" : "id_vendedor = '$id' ORDER BY id_agenda DESC"));
		$num_paginas = ceil($res['total_elementos']->rowCount() / $agenda_resultados_por_pagina);

		if($res['total_elementos']->rowCount()){
			$tabla .= "<div class='view_vendedor__ventas'>
							<div class='titulos b_superior'>
								<p>cliente</p>
								<p class='domicilio'>domicilio</p>
								<p class='telefono'>telefono</p>
								<p class='fecha'>fecha</p>
								<p>opciones</p>
							</div>";
			


			foreach($res['elementos'] as $row){
			// foreach($consulta_agenda as $row){
				$id = $row['id_agenda'];
				$cliente = $row['nombre_agenda']." ".$row['apellido_agenda'];
				$domicilio = $row['direccion_agenda'];
				$telefono = $row['telefono_agenda'];
				$fecha_registro = formato_fecha($row['fecha_agenda']);
				$tabla .= "<div class='contenido b_laterales_primary'>
							<p>$cliente</p>
							<p class='domicilio'>$domicilio</p>
							<p class='telefono'>$telefono</p>
							<p class='fecha'>$fecha_registro</p>
							<p>
								<a href='https://wa.me/".$telefono."?text=Hola $cliente' target='_blank'><i class='fa fa-whatsapp fa-lg fa-fw'></i></a>
								<a href='#' title='EDITAR CLIENTE' onclick=actionAgenda($id,'edit') ><i class='fa fa-user-edit fa-lg fa-fw'></i></a>
								<a href='#' onclick='eliminarCliente_agenda($id)' title='ELIMINAR CLIENTE'><i class='fa fa-times fa-lg fa-fw'></i></a>
							</p>
						</div>";
			}

			$tabla .= "<div class='footer b_inferior'></div></div>";
			
			echo $tabla;
		} else {
			echo "<p><b class='rojo'>NO TENES CLIENTES CON ESE NOMBRE O APELLIDO</b></p>";
		}
	} else {
		echo "<p><b class='rojo'>SIN CLIENTES REGISTRADOS</b></p>";
	}
	paginacion_v2($pagina,$num_paginas,$get);
    ?>
</div>


<div class="popup" id="popup">
	<div class="popup-content"></div>
</div>


</body>
</html>
<?php } else {header("location: ../index.php");} ?>