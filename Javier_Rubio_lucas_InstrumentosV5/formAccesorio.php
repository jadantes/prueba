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
    <h1>Formulario Accesorio</h1>
    <fieldset>
        <form method="post" action="nuevoAccesorio.php" enctype="multipart/form-data">
            <label>Accesorio nombre</label>
            <br/>
            <input type="text" name="acc_nombre" required/>
            <br/>
            <label>Accesorio Caracterisitcas</label>
            <br/>
            <textarea type="text" name="acc_cara" required></textarea>
            <br/>
            <label>Accesorio Precio</label>
            <br/>
            <input type="decimal" name="acc_precio" maxlength="10" required>
            <br/>
            <labe>Accesorio Existencia</labe>
            <br/>
            <input type="decimal" name="acc_existencia" maxlength="10" >
            <br/>
            <label>Descuento</label>
            <br/>
            <input type="decimal" name="acc_descuento" >
            <br/>
            <label>AccesorioImagen </label>
            <input type="file" name="acc_foto"/>
            <br/>

            <?php
            if ($existe = !null) {
                echo " <label>Instrumento asociados</label>";
                echo "<br/>";
            }
            while ($fila = $con->getFila()) {
                echo "<input type='checkbox' name='selectedInstrumento[]' value=" . $fila['id_instrumento'] . ">" . $fila['ins_nombre'] . "<br>";
            }

            ?>
            <br/>
            <input type="submit" name="submitAccesorio">
        </form>
    </fieldset>
    <?php
    if (isset($_GET['accesorioInsertado']) && $_GET['accesorioInsertado'] == 1) {
        echo " Accesorio Insertado Correctamente";
    }
    if (isset($_GET['acessorioInstrumentos']) && $_GET['acessorioInstrumentos'] == 1) {
        echo " con sus Instrumentos Asociados";
    }
	if (isset( $_GET['accesorioInsertado'])&& $_GET['accesorioInsertado'] ==0) {

        echo $consultas->comprobarError($_GET['error']);
	}

    ?>
</div>


</body>
</html>