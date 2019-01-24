<?php
require_once "OperacionesBDPOO.php";
if (isset($_POST['submitAccesorio']) && !empty($_POST['submitAccesorio'])) {
    $isImage = null;
    if ($_FILES['acc_foto']['name'] != "") {
        $archivo = $_FILES["acc_foto"]["tmp_name"];
        $tamanio = $_FILES["acc_foto"]["size"];
        $tipo = $_FILES["acc_foto"]["type"];
        $nombre = $_FILES["acc_foto"]["name"];
		$foto=addslashes(file_get_contents($_FILES["acc_foto"]["tmp_name"]));


        //   echo $foto;
        $isImage = strstr($tipo, '/', false);
    } else {
        echo $_POST['acc_foto'];
        $isImage = "/jpg";
        $foto = "null";
        echo "ha entrado asdfsa ";
    }
    if (($isImage == "/jpg") || ($isImage == "/jpeg")) {

        $con = new OperacionesBDPOO();
        if ($_POST['acc_existencia'] == "") {
            $existencia = "default";
        } else {
            $existencia = $_POST['acc_existencia'];
        }
        if ($_POST['acc_descuento'] == "") {
            $descuento = "null";
        } else {
            $descuento = $_POST['acc_descuento'];
        }

        $sql = "insert into accesorios(acce_nombre,acce_caracteristicas,acce_precio,acce_existencia,acce_descuento,acce_foto) values('" . $_POST['acc_nombre'] . "','" . $_POST['acc_cara'] . "'," . $_POST['acc_precio'] . "," . $existencia . "," . $descuento . ",'" . $foto . "')";

        $con->getSingleQuery($sql);


        $ultimoAccesorio = $con->ultimoId();

        if (isset($_POST['selectedInstrumento'])) {

            $instrumentos = $_POST['selectedInstrumento'];

            for ($i = 0; $i < count($instrumentos); $i++) {
                $sql = "insert into accesorios_instrumentos(id_acce_ins_instrumento,id_acce_ins_accesorios) values(" . $instrumentos[$i] . "," . $ultimoAccesorio . ")";

                echo($sql);
                $con->getSingleQuery($sql);
                $error = $con->getErroNum();
                if ($error == 0) {
                      header("location:formAccesorio.php?acessorioInstrumentos=1&&accesorioInsertado=1");
                } else {
                     header("location:formAccesorio.php?accesorioInsertado=0&&error=$error");
                }
            }
        } else {
            $error = $con->getErroNum();
            if ($error == 0) {
                 header("location:formAccesorio.php?accesorioInsertado=1&&error=$error");
            } else {
                 header("location:formAccesorio.php?accesorioInsertado=0&&error=$error");
            }
        }
    } else {
        $error = "noImage";

        echo $isImage;
        header("location:formAccesorio.php?accesorioInsertado=0&&error=$error");
    }
} else {
    header("location:formAccesorio.php?accesorioInsertado=0&&error=$error");
}