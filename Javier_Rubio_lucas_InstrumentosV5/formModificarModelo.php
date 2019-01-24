<?php
if (isset($_GET['idModelo'])) {
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
        require_once "OperacionesBDPOO.php";
        require_once 'Consultas.php';
        $consultas = new Consultas();
        $con = new OperacionesBDPOO();

        ?>

    </div>
    <div id="derecho">
        <?php

        $idModelo = $_GET['idModelo'];
        $sql = "select * from modelos where id_modelo='" . $idModelo . "';";

        $existe = $con->getSingleQuery($sql);
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
        $idModelo = $filaModelo['id_modelo'];
        ?>

        <h1>Alta Modelos</h1>
        <fieldset>
            <form method="post" action="modificarModelo.php" enctype="multipart/form-data">
                <label>Referencia</label>
                <input type="hidden" name="idHidden" value="<?php echo $filaModelo['id_modelo']?>" >
                <br/>
                <input type="text" name="mod_id" maxlength="10" value="<?php echo $filaModelo['id_modelo'] ?>"
                       required/>
                <br/>
                <label>Modelo nombre</label>
                <br/>
                <input type="text" name="mod_nombre" maxlength="20" value="<?php echo $filaModelo['mod_nombre'] ?>"
                       required/>
                <br/>
                <label>Modelo Caracterisitcas</label>
                <br/>
                <textarea type="text" name="mod_cara" required><?php echo $filaModelo['mod_descripcion'] ?></textarea>
                <br/>
                <label>Modelo Precio</label>
                <br/>
                <input type="decimal" name="mod_precio" maxlength="10" value="<?php echo $descuento ?>" required>
                <!--<input type="number" name="mod_precio"maxlength="10" step="1" required>-->

                <br/>
                <labe>Modelo Existencia</labe>
                <br/>
                <input type="decimal" value="<?php echo $existencia ?>" name="mod_existencia"/>
                <br/>
                <label>Modelo Descuento</label>
                <br/>
                <input type="decimal" value="<?php echo $filaModelo['mod_descuento'] ?>" name="mod_descuento"/>
                <br/>
                <label><img src='imagenes/<?php echo $filaModelo['mod_ruta'] ?>' width='50' height='50'></img></label>
                <input type="hidden"name="fotoHidden" value="<?php echo $filaModelo['mod_ruta']?>">
                <input type="file" value="<?php echo $filaModelo['mod_ruta'] ?>" name="foto"/>
                <br/>
                <label>Instrumento</label>
                <br/>
                <?php
                $idModeloInstrumento = $filaModelo['mod_id_instrumento'];
                $sql = "select * from instrumentos";
                $con->getSingleQuery($sql);
                ?>
                <select name="instrumento" selected="selected" required>
                    <?php
                    if ($con->getNumRow() == 0) {
                        echo '<option value="0">no hay Instrumentos</option>';

                    } else {
                        while ($fila = $con->getFila()) {
                            if ($idModeloInstrumento == $fila['id_instrumento']) {
                                echo '<option selected="selected" value="' . $fila['id_instrumento'] . '">' . $fila['ins_nombre'] . '</option>';
                            } else {
                                echo '<option value="' . $fila['id_instrumento'] . '">' . $fila['ins_nombre'] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
                <br/>
                <br/>
                <input type="submit" name="modificar-modelo" value="modificar">
            </form>

        </fieldset>
        <?php


        if (isset($_GET['insertado']) && $_GET['insertado'] == 1) {
            echo "insertado correctamente";
            echo '<br/>';
            echo "numero de filas afectadas " . $_GET['insertado'];
        } elseif (isset($_GET['insertado']) && $_GET['insertado'] == 0) {
            echo "no ha entrado en nuevoModelo";
        } elseif (isset($_GET['error'])) {
            echo $consultas->comprobarError($_GET['error']);
        }
        ?>
    </div>


    </body>
    </html>
    <?php
} else {
    header("location:listadoModelos.php");
}