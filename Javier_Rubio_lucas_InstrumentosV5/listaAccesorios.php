<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 19/12/2018
 * Time: 19:07
 */
if($_POST['tipo']=='sinAsociar'){

    header('location:panelAccesorio.php?sinAsociar=sinAsociar.php');
}

if (isset($_POST['submitDespliegueAccesorio']) && !empty($_POST['tipo'])) {


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
        <?php include("header.php");
        require_once 'OperacionesBDPOO.php';
        ?>
    </div>
    <div ID="izquierdo">

        <?php include("menu.php");
        $con = new OperacionesBDPOO();
        $sql = "select tip_nombre from tipos where id_tipo=".$_POST['tipo'].";";
        $con->getSingleQuery($sql);
        $filaTipo=$con->getFila();
        ?>
    </div>

    <div id="derecho">

        <?php
        echo '    <h1> Tipo Instrumentos ' . $filaTipo['tip_nombre']. ' </h1>';

        $sql = "select * from instrumentos where ins_tipo_id=" . $_POST['tipo'];
        $con->getSingleQuery($sql);

        ?>
        <fieldset>
        <form action="panelAccesorio.php" method="post">
        <label>instrumentos</label>
        <select name="instrumento" selected="selected" required>
            <?php
            if ($con->getNumRow() == 0) {
                echo '<option value="0">no hay instrumentos en la base datos</option>';
            } else {
                while ($fila = $con->getFila()) {
                    echo '<option value="' . $fila['id_instrumento'] . '">' . $fila['ins_nombre'] . '</option>';
                }
            }

            ?>

        </select>
        <input type="submit" name="submitDespliegueAccesorio">
        </form>
        </fieldset>
    </div>
    </body>
    </html>
    <?php
} else {
     header('location:despliegueAccesorio.php');
}