<?php include("../php/includes_user.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 0){
	$id = $_SESSION['id'];
	?>
<body>
<div id="contenido">
		<?php
		
		$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1 ;
		$res = resultados_paginacion($compras_resultados_por_pagina, $pagina, "ventascliente", "id_usuario = $id ORDER BY fecha DESC");
		$num_paginas = ceil($res['total_elementos']->rowCount() / $compras_resultados_por_pagina);

		if($res['total_elementos']->rowCount()){
			if(!isset($_GET['compra'])){
				echo '<div class="user_compras">';
				foreach($res['elementos'] as $d){
					$fecha = formato_fecha($d['fecha']);
					$estado = ($d['estado'] == 0) ? "orange" : (($d['estado'] == 1) ? "green" : "red"); ?>
					<div class="compras" <?=borde_compras($estado)?>>
						<p title="FECHA DE LA COMPRA"><?=$fecha?></p>
						<p title="MONTO TOTAL"><?=formato_precio($d['total'])?></p>
						<a href="compras.php?compra=<?=$d['ID']?>" title="VER PEDIDO"><i class="fa fa-list-alt fa-lg fa-fw"></i></a>
					</div>
				<?php }
				echo '</div>';
				paginacion(false,$pagina,$num_paginas,false);
			} else {
				compras_detalles($_GET['compra']); ?>
				<input class="btn_atras btn_morado" onclick="history.back()" type="button" value="VOLVER ATRAS">
		<?php }
		} else {
			echo "<p><b class='rojo'>NO TIENE COMPRAS HECHAS TODAVIA</b></p>";
		} ?>
</div>  
</body>
</html>
<?php } else {header("location: ../index.php");} ?>