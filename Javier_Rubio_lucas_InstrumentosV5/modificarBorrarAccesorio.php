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
    require_once 'OperacionesBDPOO.php';
    ?>
</div>
<div ID="izquierdo">

    <?php include("menu.php");


    ?>
</div>

<div id="derecho">
    <?php
    if (isset($_GET['idAccesorio']) && !empty($_GET['idAccesorio'] && $_GET['accion'] == 'modificar')) {

        $con = new OperacionesBDPOO();
        $sql = "select * from accesorios where id_accesorio=" . $_GET['idAccesorio'] . ";";
        //   echo $sql;
        $con->getSingleQuery($sql);
        $fila = $con->getFila();

        ?>
        <form action="modificarAccesorio.php?idAccesorio=<?php echo $_GET['idAccesorio']?>&&idInstrumento=<?php echo $_GET['idInstrumento']?>" method="post">
			<label><span>Nombre del Instrumento:</span><?php echo $_GET['insNombre'] ?></label>
            <br/>
            <label><span>Nombre Accesorio:</span></label>
			<label><?php echo $fila['acce_nombre']?></label>
            <br/>
			<label><span>Descripcion Accesorio:</span></label>
            <label><?php echo $fila['acce_caracteristicas']?></label>
            <br/>
			<label><span>Precio sin descuento</span></label>
        <input name="precioAccesorio" type="number" step="0.01" maxlength="10" value="<?php echo $fila['acce_precio']?>">
            <br/>
            <input type="submit" name="submitModificarAccesorio" value="modificar">

        </form>
        <?php
    }
    if (isset($_GET['idAccesorio']) && !empty($_GET['idAccesorio'] && $_GET['accion'] == 'borrar')) {
?>
        <form method="post" action="borrarAccesorio.php?idAccesorio=<?php echo $_GET['idAccesorio']?>&&idInstrumento=<?php echo $_GET['idInstrumento']?>">
        <h2>¿estas seguro de que quieres borrar?</h2>
    <input type="submit" name="submitSiBorrar" value="SI">
        <input type="submit" name="submitNoBorrar" value="NO">
        </form>
    <?php
    }

    ?>

</div>
</body>
</html>
