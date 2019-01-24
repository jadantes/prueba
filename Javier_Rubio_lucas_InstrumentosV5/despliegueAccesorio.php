<?php

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
    <?php include("header.php"); ?>

    <?php
    require_once "OperacionesBDPOO.php";
    require_once 'Consultas.php';
    $consultas = new Consultas();
    $con = new OperacionesBDPOO();
    $sql = "select * from tipos";
    $con->getSingleQuery($sql);
    ?>
</div>
<div ID="izquierdo">

    <?php include("menu.php");
    ?>

</div>
<div id="derecho">
    <form action="listaAccesorios.php" method="post">
    <h1>Accesorios con sus Instrumentos</h1>


    <?php
    if ($con->getNumRow() == 0) {

    $sql = "select * from accesorios";
    $con->getSingleQuery($sql);
    if ($con->getNumRow() == 0) {
        echo "<h2> No hay accesorios</h2>";
    }

    else{
    ?>

    <select name="instrumento" selected="selected" required>
        echo '
        <option value="sinAsociar">Sin asociar</option>
        <?php
        }
        } else {
        ?>
        <select name="tipo" selected="selected" required>
            <?php
            if ($con->getNumRow() == 0) {
                echo '<option value="0">no hay tipos en la base datos</option>';
            } else {
                while ($fila = $con->getFila()) {
                    echo '<option value="' . $fila['id_tipo'] . '">' . $fila['tip_nombre'] . '</option>';
                }
            }
            echo '<option value="sinAsociar">Sin asociar</option>';
            }
            ?>

        </select>
        <input type="submit" name="submitDespliegueAccesorio">
        </form>
</div>
</body>
</html>