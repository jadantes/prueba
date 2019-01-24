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

    <?php require_once 'OperacionesBDPOO.php';
    require_once 'Consultas.php';
    $consultas = new Consultas();
    $con = new OperacionesBDPOO();
    $sql = "select * from tipos";
    $con->getSingleQuery($sql);


    ?>

</div>
<div id="derecho">
    <h1>Formulario Instrumentos</h1>
    <fieldset>
        <form action="nuevoInstrumento.php" method="post">
            <label type="text">Nombre</label>
            <br/>
            <input type="text" name="nombre" required>
            <br/>
            <label type="text">Tipo instrumento</label>
            <br/>
            <select name="tipoInstrumento" selected="selected" required>
                <?php

                if ($con->getNumRow() == 0) {
                    echo '<option value="0">no hay tipos en la base datos</option>';
                } else {
                    while ($fila = $con->getFila()) {
                        echo '<option value="' . $fila['id_tipo'] . '">' . $fila['tip_nombre'] . '</option>';
                    }
                }
                ?>
            </select>
            <br/>
            <br/>
            <input type="submit" name="submitInstrumento" value="enviar">

        </form>
    </fieldset>

    <?php

    if (isset($_GET['insertado']) && $_GET['insertado'] == 1) {
        echo "insertado correctamente";
        echo '<br/>';
        echo  "numero de filas afectadas ".$_GET['insertado'];
    } elseif (isset($_GET['insertado']) && $_GET['insertado'] == 0) {
        echo "no se ha podido insertar";
    } elseif (isset($_GET['error'])) {
     echo $consultas->comprobarError($_GET['error']);
    }
    ?>

</div>
</body>
</html>