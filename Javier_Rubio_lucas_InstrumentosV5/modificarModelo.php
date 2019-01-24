<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/11/2018
 * Time: 13:38
 */

require_once 'OperacionesBDPOO.php';
$con = new OperacionesBDPOO();

if (isset($_POST['modificar-modelo'])) {
    if ($_FILES['foto']['name'] != "") {
        echo $_FILES['foto']['type'];

        var_dump($_FILES['foto']['name']);

        $fichero = 'imagenes/';
        $fichero_subido = $fichero . $_FILES['foto']['name'];
        $tipo = $_FILES['foto']['type'];
        $isImgage = strstr($tipo, '/', true);
        //  echo $isImgage;
        $ruta = "'" . $_FILES['foto']['name'] . "'";
    } else {
        $isImgage = "image";
        $ruta ="'".$_POST['fotoHidden']."'";
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
        $sql = "update modelos SET id_modelo = '" . $_POST['mod_id'] . "', mod_nombre = '" . $_POST['mod_nombre'] . "', mod_descripcion = '" . $_POST['mod_cara'] . "', mod_precio = " . $_POST['mod_precio'] . ", mod_existencia = " . $existencia . ", mod_descuento = $descuento, mod_id_instrumento = '" . $_POST['instrumento'] . "', mod_ruta =".$ruta." where id_modelo = '" . $_POST['idHidden'] . "';";
        $con->getSingleQuery($sql);
        $error = $con->getErroNum();
        $insertado = true;
        echo $sql;

        if ($error == 0) {

            if (copy($_FILES['foto']['tmp_name'], $fichero_subido)) {
            } else {
                echo "error en la subida";
            }

            $filasAfectadas = $con->getAfecctedRow();

            header("location:listarModelos.php?insertado=1&filas=$filasAfectadas");
        } else {

            header("location:listarModelos.php?error=$error");


        }
    } else {
        $error = "noImage";
        header("location:formModificarModelo.php?error=$error");
    }
} else {

    header("location:formModificarModelo.php?insertado=0");
}