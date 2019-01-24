<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div id="arriba">
    <?php include("header.php");
    require_once "OperacionesBDPOO.php";
    ?>
</div>
<div ID="izquierdo">

    <?php include("menu.php"); ?>
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
</div>
<div id="derecho">
    <?php

    if (isset($_POST['submitConsulta'])) {
        $con = new OperacionesBDPOO();
        $sql = "select ins_nombre,mod_nombre,m.id_modelo from instrumentos i,modelos m where i.id_instrumento = m.mod_id_instrumento and i.id_instrumento=" . $_POST['instrumento'] . ";";
        $con->getSingleQuery($sql);

        if ($con->getNumRow() == 0) {
            echo '<h2>no hay modelos asociados</h2>';
        } else {
            ?>
            <h2>Modelos</h2>
            <table>
                <thead>
                <th>N.Instrumento</th>
                <th>M.Nombre</th>
                <th>Detalles</th>
                </thead>
                <tbody>

                <?php

                while ($filas = $con->getFila()) {
                    $instrumento = $_POST['instrumento'];
                    $modelo=$filas['id_modelo'];
                    echo " <tr>";
                    echo "<td>" . $filas['ins_nombre'] . "</td>";
                    echo "<td>" . $filas['mod_nombre'] . "</td>";
                    echo "<td><a href='descripcionModelos.php?idModelo=$modelo&&idInstrumento=$instrumento'>Descripcion</a></td>";
                    echo "</tr>";
                }
                ?>
                </tr>
                </tbody>
            </table>

            <?php
        }
    } else {
        echo "has entrado por url?";
    }
    ?>
</div>
</body>
</html>