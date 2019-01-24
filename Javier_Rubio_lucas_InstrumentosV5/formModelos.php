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
    require_once 'Consultas.php';
    $consultas = new Consultas();

    $con = new OperacionesBDPOO();
    $sql = "select * from instrumentos";
    $existe = $con->getSingleQuery($sql);
    ?>

</div>
<div id="derecho">
<?php
if ($con->getNumRow() == 0) {
    echo "<h1> No hay instrumentos, no puedes insertar modelos</h1>";
} else {

    ?>

    <h1>Alta Modelos</h1>
    <fieldset>
        <form method="post" action="nuevoModelo.php" enctype="multipart/form-data">
            <label>Referencia</label>
            <br/>
            <input type="text" name="mod_id" maxlength="10" required/>
            <br/>
            <label>Modelo nombre</label>
            <br/>
            <input type="text" name="mod_nombre" maxlength="20" required />
            <br/>
            <label>Modelo Caracterisitcas</label>
            <br/>
            <textarea type="text" name="mod_cara" required></textarea>
            <br/>
            <label>Modelo Precio</label>
            <br/>
            <input type="decimal" name="mod_precio"maxlength="10" required>
			<!--<input type="number" name="mod_precio"maxlength="10" step="1" required>-->

            <br/>
            <labe>Modelo Existencia</labe>
            <br/>
            <input type="decimal" name="mod_existencia"/>
            <br/>
            <label>Modelo Descuento</label>
            <br/>
            <input type="decimal" name="mod_descuento" />
            <br/>
            <label>Modelo Imagen</label>
            <input type="file" name="foto"  />
            <br/>
            <label>Instrumento</label>
            <br/>
            <select name="instrumento" selected="selected" required>
                <?php

                if ($con->getNumRow() == 0) {
                    echo '<option value="0">no hay tipos en la base datos</option>';
                } else {
                    while ($fila = $con->getFila()) {
                        echo '<option value="' . $fila['id_instrumento'] . '">' . $fila['ins_nombre'] . '</option>';
                    }
                }
                ?>
            </select>
            <br/>
            <input type="submit" name="submitModelo">
        </form>
    </fieldset>
    <?php

}
    if (isset($_GET['insertado']) && $_GET['insertado'] == 1) {
        echo "insertado correctamente";
        echo '<br/>';
        echo  "numero de filas afectadas ".$_GET['insertado'];
    } elseif (isset($_GET['insertado']) && $_GET['insertado'] == 0) {
        echo "no ha entrado en nuevoModelo";
    } elseif (isset($_GET['error'])) {
     echo $consultas->comprobarError($_GET['error']);
    }
    ?>
</div>


</body>
</html>