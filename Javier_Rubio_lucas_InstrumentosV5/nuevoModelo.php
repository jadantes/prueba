<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/11/2018
 * Time: 13:38
 */

require_once 'OperacionesBDPOO.php';
$con = new OperacionesBDPOO();

if (isset($_POST['submitModelo'])) {
	if ($_FILES['foto']['name'] != "") {
		echo $_FILES['foto']['type'];
		echo "ha entrado files";
		var_dump($_FILES['foto']['name']);

		$fichero = 'imagenes/';
		$fichero_subido = $fichero . $_FILES['foto']['name'];
		$tipo = $_FILES['foto']['type'];
		$isImgage = strstr($tipo, '/', true);
		//  echo $isImgage;
		$ruta = "'" . $_FILES['foto']['name'] . "'";
	} else {
		$isImgage = "image";
		$ruta = "null";
	}

	if ($isImgage == 'image') {
		$con = new OperacionesBDPOO();
		if ($_POST['mod_existencia'] == "") {
			$existencia = "default";
		} else {
			$existencia = $_POST['mod_existencia'];
		}
		if ($_POST['mod_descuento'] == "") {
			$descuento = "null";
		} else {
			$descuento = "" . $_POST['mod_descuento'] . "";
		}
		$sql = "insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento,mod_ruta) values('" . $_POST['mod_id'] . "','" . $_POST['mod_nombre'] . "','" . $_POST['mod_cara'] . "'," . $_POST['mod_precio'] . "," . $existencia . "," . $descuento . "," . $_POST['instrumento'] . "," . $ruta . ")";
		echo $sql;
		$con->getSingleQuery($sql);
		$error = $con->getErroNum();
		$insertado = true;
		if ($error == 0) {

			if (copy($_FILES['foto']['tmp_name'], $fichero_subido)) {
			} else {
				echo "error en la subida";
			}
			$filasAfectadas = $con->getAfecctedRow();
			echo $sql;
			header("location:formModelos.php?insertado=1&filas=$filasAfectadas");
		} else {
			header("location:formModelos.php?error=$error");
		}
	} else {
		$error = "noImage";
		header("location:formModelos.php?error=$error");
	}
} else {
	header("location:formModelo.php?insertado=0");
}