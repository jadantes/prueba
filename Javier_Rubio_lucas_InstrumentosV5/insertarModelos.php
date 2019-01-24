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
    <?php
    require_once "OperacionesBDPOO.php";
    $con = new OperacionesBDPOO();
    $sql = " select id_instrumento from instrumentos";


    $con->getSingleQuery($sql);
    $id_instrumento = $con->getFila();
    //ffr echo $id_instrumento['id_instrumento'];

    ?>

</div>
<div id="derecho">
    <?php

    if ($id_instrumento != null) {
        $sql = "select * from modelos";

        $con->getSingleQuery($sql);
        $id_modelo = $con->getFila();
        if ($id_modelo == null) {
            $sql = "insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento) values('car1','nombre1','descripcion1',1,'',null," . $id_instrumento['id_instrumento'] . ");
insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento) values('car2','nombre2','descripcion2',2,'',null," . $id_instrumento['id_instrumento'] . ");
insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento) values('car3','nombre3','descripcion3',3,'',null," . $id_instrumento ['id_instrumento'] . ");
insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento) values('car4','nombre4','descripcion4',4,'',null," . $id_instrumento['id_instrumento'] . ");";
            $con->getMultiQuery($sql);
            echo "insertado correctamente";
        } else {
            echo " ya existe modelos insertados";
        }
        //    echo($sql);

    } else {
        echo " no hay instrumentos y no puedes inseratr modelos";
    }
    ?>

</div>
</body>
</html>