<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 19/12/2018
 * Time: 19:07
 */

if (isset($_POST['submitDespliegueAccesorio']) && !empty($_POST['instrumento']) || isset($_GET['idInstrumento']) || isset($_GET['sinAsociar'])) {


$asociados=true;

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>

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
    <div id="arriba">
        <?php include("header.php");
        require_once 'OperacionesBDPOO.php';
        ?>
    </div>
    <div ID="izquierdo">

        <?php include("menu.php");
        $con = new OperacionesBDPOO();

        if(isset($_GET['sinAsociar'])) {
            $sql = "select * from accesorios where id_accesorio not in(select id_acce_ins_instrumento from accesorios_instrumentos);";
            // echo $sql;
           $con->getSingleQuery($sql);
           $asociados=false;
        }
        else {
            if(isset($_GET['idInstrumento'])){
                $idInstrumento=$_GET['idInstrumento'];
            }
            else{
                $idInstrumento=$_POST['instrumento'];
            }

        $sql = "select id_acce_ins_instrumento,acce_nombre,acce_caracteristicas,acce_precio,acce_descuento,id_accesorio,ins_nombre,id_instrumento from accesorios_instrumentos ai,accesorios a,instrumentos i where ai.id_acce_ins_accesorios=a.id_accesorio and ai.id_acce_ins_instrumento=" . $idInstrumento." and i.id_instrumento=".$idInstrumento.";";
     //   echo $sql;
        $con->getSingleQuery($sql);
}


        ?>
    </div>

    <div id="derecho">
<h1>Accesorio Asociados </h1>
        <table>
            <thead>
            <th>I.Nombre</th>
            <th>A.Nombre</th>
            <th>A.Descripcion</th>
            <th>A.Precio</th>
            <th>Modificar</th>
            <th>Borrar</th>

            </thead>
            <tbody>
            <?php

    if($asociados){
            while ($filas = $con->getFila()) {

                echo " <tr>";
                echo "<td>" . $filas['ins_nombre'] . "</td>";
                echo "<td>" . $filas['acce_nombre'] . "</td>";
                echo "<td>" . $filas['acce_caracteristicas'] . "</td>";
                echo "<td>" . $filas['acce_precio'] . "</td>";
                $idAccesorio=$filas['id_accesorio'];
                $insNombre=$filas['ins_nombre'];
                $id_instrumento=$filas['id_instrumento'];
                echo "<td><a href='modificarBorrarAccesorio.php?idAccesorio=$idAccesorio&&insNombre=$insNombre&&accion=modificar&&idInstrumento=$id_instrumento'>Modficiar</a></td>";
                echo "<td><a href='modificarBorrarAccesorio.php?idAccesorio=$idAccesorio&&insNombre=$insNombre&&accion=borrar&&idInstrumento=$id_instrumento'>Borrar</a></td>";

                echo "</tr>";
            }
    }
    else{
        while ($filas = $con->getFila()) {

            echo " <tr>";
            echo "<td>no tiene</td>";
            echo "<td>" . $filas['acce_nombre'] . "</td>";
            echo "<td>" . $filas['acce_caracteristicas'] . "</td>";
            echo "<td>" . $filas['acce_precio'] . "</td>";
            $idAccesorio=$filas['id_accesorio'];

            echo "<td><a href='modificarBorrarAccesorio.php?idAccesorio=$idAccesorio&&insNombre=SinNombre&&accion=modificar&&idInstrumento=0'>Modficiar</a></td>";
            echo "<td><a href='modificarBorrarAccesorio.php?idAccesorio=$idAccesorio&&insNombre=SinNombre&&accion=borrar&&idInstrumento=0'>Borrar</a></td>";

            echo "</tr>";
        }
    }
            ?>

            </tr>
            </tbody>
        </table>

    </div>
    </body>
    </html>
    <?php


} else {
    header('location:despliegueAccesorio.php');
}