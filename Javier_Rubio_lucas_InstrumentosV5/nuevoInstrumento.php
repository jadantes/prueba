<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/11/2018
 * Time: 13:38
 */

require_once 'OperacionesBDPOO.php';
$con = new OperacionesBDPOO();

if (isset($_POST['submitInstrumento'])) {

    if ($_POST['tipoInstrumento'] == "0") {
        header("location:formInstrumento.php?insertado=0");

    } else {

        $sql = "insert into instrumentos(ins_nombre,ins_tipo_id) values('" . $_POST['nombre'] . "'," . $_POST['tipoInstrumento'] . ")";
        $con->getSingleQuery($sql);
        $error = $con->getErroNum();
        $insertado = true;
        if ($error == 0) {
           $filasAfectadas=$con->getAfecctedRow();
            header("location:formInstrumento.php?insertado=1&filas=$filasAfectadas");
        }
        else{
            header("location:formInstrumento.php?error=$error");
        }
// var_dump($_POST['tipoInstrumento']);
    }
} else {
    // $insertado=false;
    //$_GET['insertado']=0;
    header("location:formInstrumento.php?insertado=0");
}