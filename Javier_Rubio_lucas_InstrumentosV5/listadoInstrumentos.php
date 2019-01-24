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
<style>
    tr{

        background-color: yellow;
    }
    tr:nth-child(even){

        background-color: deepskyblue;
    }

    tr:hover {

        background-color: white
    }
    th{
        background-color: white;
    }

</style>
<div ID="izquierdo">

    <?php include("menu.php"); ?>
    <?php require_once "OperacionesBDPOO.php";
    $con = new OperacionesBDPOO();
    $sql = "select ins_nombre,tip_nombre from instrumentos inner join tipos on instrumentos.ins_tipo_id=tipos.id_tipo;";
    $con->getSingleQuery($sql);//echo $sql;


    ; ?>

</div>
<div id="derecho">
    <?php if ($con->getNumRow() == 0) {
        echo "<h1> Listado de Instrumentos Esta vacio</h1>";
    } else {
        ?>
        <table>
            <thead>
            <th>N.Instrumento</th>
            <th>T.Nombre</th>
            </thead>
            <tbody>

            <?php

           while ($filas = $con->getFila()) {
                echo " <tr>";
                echo "<td>" . $filas['ins_nombre'] . "</td>";
                echo "<td>" . $filas['tip_nombre'] . "</td>";
                echo "</tr>";
            }

            ?>
            </tr>
            </tbody>
        </table>

        <?php
    }
    ?>

</div>
</body>
</html>