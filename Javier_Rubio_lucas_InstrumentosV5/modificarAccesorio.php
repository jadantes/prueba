<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 19/12/2018
 * Time: 21:48
 */
require_once 'OperacionesBDPOO.php';
$con = new OperacionesBDPOO();

if (isset($_POST['submitModificarAccesorio'])&& !empty($_POST['precioAccesorio'])) {
    $sql="update accesorios SET acce_precio=".$_POST['precioAccesorio']." where id_accesorio =".$_GET['idAccesorio'].";";
    echo $sql;
    $con->getSingleQuery($sql);
    if($con->getErroNum()==0){
        $idInstrumento=$_GET['idInstrumento'];
        echo $_GET['idInstrumento'];

        if ($_GET['idInstrumento']==0){
            header('location:panelAccesorio.php?sinAsociar=sinAsociar.php');
        }
        else {
            header('location:panelAccesorio.php?idInstrumento=' . $idInstrumento, '.php');
        }
    }

}
else{
    header('location:panelAccesorio.php');
}