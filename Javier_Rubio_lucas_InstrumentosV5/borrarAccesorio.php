<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 19/12/2018
 * Time: 21:48
 */
require_once 'OperacionesBDPOO.php';
$con = new OperacionesBDPOO();
$idInstrumento = $_GET['idInstrumento'];


if (isset($_POST['submitSiBorrar']) && !empty($_GET['idAccesorio'])) {
    $sql = "delete from accesorios_instrumentos where id_acce_ins_accesorios=" . $_GET['idAccesorio'] . ";";
    echo $sql;
    $con->getSingleQuery($sql);
    if ($con->getErroNum() == 0) {
        $sql = "delete from accesorios where id_accesorio=" . $_GET['idAccesorio'] . ";";
        echo $sql;
        $con->getSingleQuery($sql);
        if ($con->getErroNum() == 0) {

            if ($_GET['idInstrumento'] == 0) {
                header('location:panelAccesorio.php?sinAsociar=sinAsociar.php');
            } else {
                header('location:panelAccesorio.php?idInstrumento=' . $idInstrumento, '.php');
            }
        }

    }
} elseif (isset($_POST['submitNoBorrar']) && !empty($_GET['idAccesorio'])) {

    //     echo $_GET['idInstrumento'];

    if ($_GET['idInstrumento'] == 0) {
        header('location:panelAccesorio.php?sinAsociar=sinAsociar.php');
    } else {
        header('location:panelAccesorio.php?idInstrumento=' . $idInstrumento, '.php');
    }
} else {
    if ($_GET['idInstrumento'] == 0) {
        header('location:panelAccesorio.php?sinAsociar=sinAsociar.php');
    } else {
        header('location:panelAccesorio.php?idInstrumento=' . $idInstrumento, '.php');
    }
}