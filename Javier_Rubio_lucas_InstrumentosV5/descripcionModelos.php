<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 09/12/2018
 * Time: 19:23
 */
session_start();

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
</div>
<div ID="izquierdo">

    <?php include("menu.php");
    require_once 'OperacionesBDPOO.php';
    $con = new OperacionesBDPOO();
    $sql = "select * from modelos where id_modelo='" . $_GET['idModelo'] . "'";
    //echo $sql;
    $con->getSingleQuery($sql);

    ?>

</div>
<div id="derecho">
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

    <table>
        <thead>
        <th>Id.Modelo</th>
        <th>M.Nombre</th>
        <th>M.Descripcion</th>
        <th>M.Existencia</th>
        <th>M.Descuento</th>
        <th>M.Precio</th>
        <th>M.Foto</th>
        </thead>
        <tbody>

        <?php


        $filaModelo = $con->getFila();


        if ($filaModelo['mod_existencia'] == '0') {
            $existencia = "no hay existencias";
        } else {
            $existencia = $filaModelo['mod_existencia'];
        }

        if ($filaModelo['mod_descuento'] == null) {
            $descuento = "descuento sin asignar";
        } else {
            $descuento = $filaModelo['mod_descuento'];
        }


        echo " <tr>";
        echo "<td>" . $filaModelo['id_modelo'] . "</td>";
        echo "<td>" . $filaModelo['mod_nombre'] . "</td>";
        echo "<td>" . $filaModelo['mod_descripcion'] . "</td>";
        echo "<td>" . $existencia . "</td>";
        echo "<td>" . $descuento . "</td>";
        echo "<td>" . $filaModelo['mod_precio'] . "</td>";
        echo "<td><div class='imagen'></div><img src='imagenes/" . $filaModelo['mod_ruta'] . "'  width='50' height='50'></img></div></div></td>";
        echo "</tr>";

        ?>
        </tr>
        </tbody>
    </table>
    <br/>


    <?php
    // $sql = "select ins_nombre,mod_nombre from instrumentos i,modelos m where i.id_instrumento = m.mod_id_instrumento and i.id_instrumento=" . $_POST['instrumento'] . ";";

    $sql = "select id_acce_ins_instrumento,acce_nombre,acce_caracteristicas,acce_precio,acce_foto from accesorios_instrumentos ai,accesorios a where ai.id_acce_ins_accesorios=a.id_accesorio and ai.id_acce_ins_instrumento=" . $_GET['idInstrumento'];
    // echo $sql;
    $con->getSingleQuery($sql);
    if ($con->getNumRow() == 0) {
        echo '<h2>no hay accesorios asociados</h2>';
    } else {
        ?>
        <h2>Te puede interesar</h2>
        <table>
            <thead>

            <th>A.Nombre</th>
            <th>A.Descripcion</th>
            <th>A.Precio</th>
            <th>N.Modelo</th>
            <th>A.Foto</th>
            </thead>
            <tbody>
            <?php
            while ($filas = $con->getFila()) {

                echo " <tr>";

                echo "<td>" . $filas['acce_nombre'] . "</td>";
                echo "<td>" . $filas['acce_caracteristicas'] . "</td>";
                echo "<td>" . $filas['acce_precio'] . "</td>";
                echo "<td>" . $filaModelo['mod_nombre'] . "</td>";
                $foto = $filas['acce_foto'];

                echo "<td><img src='data:image/jpg;base64,".base64_encode( $foto)."' width='50' height='50'></td>";

                echo "</tr>";
            }
            ?>
            </tr>
            </tbody>
        </table>
        <?php
    }
    ?>

    <br/>
    <br/>
    <br/>
    <br/>

    <h2>ultimas busquedas</h2>
    <?php
    if (isset($_SESSION['busquedasModelos'])) {

        $contador = $_SESSION['contador'];
        $aModelo = $_SESSION['busquedasModelos'];
        $aModelo[$contador] = [$_GET['idModelo'], $filaModelo['mod_nombre'], $_GET['idInstrumento']];

        for ($i = 0; $i < count($aModelo); $i++) {

            $idModelo = $aModelo[$i][0];
            $mNombre = $aModelo[$i][1];
            $instrumento = $aModelo[$i][2];

            echo "ID " . $idModelo . "  mNombre = " . $mNombre;
            echo "<a href='descripcionModelos.php?idModelo=$idModelo&&idInstrumento=$instrumento'>Descripcion</a>";
            echo "<br>";
        }


        $_SESSION['busquedasModelos'] = $aModelo;
        $contador++;
        if ($contador == 5) {
            $contador = 0;
        }
        var_dump($aModelo);
        echo '<br/>';
        $_SESSION['contador'] = $contador;
        echo $contador;
    } else {
        $_SESSION['contador'] = 0;
        $contador = $_SESSION['contador'];
        $aModelo[$contador] = [$_GET['idModelo'], $filaModelo['mod_nombre'], $_GET['idInstrumento']];

        for ($i = 0; $i < count($aModelo); $i++) {

            $idModelo = $aModelo[$i][0];
            $mNombre = $aModelo[$i][1];
            $instrumento = $aModelo[$i][2];

            echo "ID " . $idModelo . "  mNombre = " . $mNombre;
            echo "<a href='descripcionModelos.php?idModelo=$idModelo&&idInstrumento=$instrumento'>Descripcion</a>";
            echo "<br>";
        }
        $_SESSION['busquedasModelos'] = $aModelo;
        $contador++;
        $_SESSION['contador'] = $contador;

        echo $contador;

    }
    ?>

</div>
</body>
</html>