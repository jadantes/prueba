<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div id="arriba">
    <?php include("header.php");?>
</div>
<div ID="izquierdo">

    <?php include("menu.php");
    require_once 'OperacionesBDPOO.php';
    $con = new OperacionesBDPOO();
    $sql = "select * from modelos ";
    //echo $sql;
    $con->getSingleQuery($sql);

    ?>

</div>
<div id="derecho">
    <style>
        tr {

            background-color: yellow;
        }

        tr:nth-child(even) {

            background-color: deepskyblue;
        }

        tr:hover {

            background-color: white
        }

        th {
            background-color: white;
        }

    </style>
	<?php if ($con->getNumRow() == 0) {
        echo "<h1> Listado de Modelos Esta vacio</h1>";
    } else {
		?>
		<table>
			<thead>
			<th>Id.Modelo</th>
			<th>M.Nombre</th>
			<th>M.Descripcion</th>
			<th>M.Existencia</th>
			<th>M.Descuento</th>
			<th>M.Precio</th>
			<th>M.Foto</th>
			<th>Modificar</th>
			<th><button><a href="imprimirPDF.php">Imprimir</a> </button></th>
			</thead>
			<tbody>

			<?php

			while ($filaModelo = $con->getFila()) {


				if ($filaModelo['mod_existencia'] == '0') {
					$existencia = "no hay existencias";
				} else {
					$existencia = $filaModelo['mod_existencia'];
				}

				if ($filaModelo['mod_descuento'] == null) {
					$descuento = "descuento sin asignar";
				} else {
					$descuento = $filaModelo['mod_descuento'];
				}
				$idModelo = $filaModelo['id_modelo'];

				echo " <tr>";
				echo "<td>" . $filaModelo['id_modelo'] . "</td>";
				echo "<td>" . $filaModelo['mod_nombre'] . "</td>";
				echo "<td>" . $filaModelo['mod_descripcion'] . "</td>";
				echo "<td>" . $existencia . "</td>";
				echo "<td>" . $descuento . "</td>";
				echo "<td>" . $filaModelo['mod_precio'] . "</td>";
				echo "<td><div class='imagen'></div><img src='imagenes/" . $filaModelo['mod_ruta'] . "'  width='50' height='50'></img></div></td>";
				echo "<td><a href='formModificarModelo.php?idModelo=$idModelo'>Modificar</a></td>";
				echo "</tr>";
			}
			?>
			</tr>
			</tbody>
		</table>

		<br/>
		<?php
	}
	?>

</div>
</body>
</html>