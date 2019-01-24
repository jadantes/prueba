<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 09/12/2018
 * Time: 16:02
 */
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

    <?php include("menu.php");
    require_once "OperacionesBDPOO.php";
    $con = new OperacionesBDPOO();
    $sql = "select * from instrumentos";
    $existe = $con->getSingleQuery($sql);
    ?>


</div>
<div id="derecho">
    <h2>Instrumentos disponibles para consultar Modelos</h2>
    <form action="consultaModelosInstrumentos.php" method="post">


        <select name="instrumento" selected="selected" required>
            <?php

            if ($con->getNumRow() == 0) {
                echo '<option value="0">no hay instrumentos en la base datos</option>';
            } else {
                while ($fila = $con->getFila()) {
                    echo '<option value="' . $fila['id_instrumento'] . '">' . $fila['ins_nombre'] . '</option>';
                }
            }

            ?>
        </select>
        <input type="submit" name="submitConsulta" value="enviar">
    </form>
</div>
</body>
</html>