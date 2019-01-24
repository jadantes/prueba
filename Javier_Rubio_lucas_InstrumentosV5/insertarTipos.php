<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/11/2018
 * Time: 11:35
 */

require_once 'OperacionesBDPOO.php';

$con = new OperacionesBDPOO();

$sql = "select * from tipos";
$tipos = $con->getSingleQuery($sql);
$fila = $con->getFila();

?>

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

    <?php include("menu.php"); ?>

</div>
<div id="derecho">
    <?php
    if ($fila['id_tipo'] == null) {

        $sql = "insert into tipos (id_tipo,tip_nombre) values(null,'cuerda');
insert into tipos (id_tipo,tip_nombre) values(null,'viento');
insert into tipos (id_tipo,tip_nombre) values(null,'viento-metal');
insert into tipos (id_tipo,tip_nombre) values(null,'percusion');";

        $con->getMultiQuery($sql);
        echo "insertado correctamente";
        ?>


        <?php

    } else {
        echo " ya existen datos en a base de datos no es posible hacer la inserccion masiva";
        ?>
        <br/>

        <?php
    }
    ?>

</div>
</body>
</html>