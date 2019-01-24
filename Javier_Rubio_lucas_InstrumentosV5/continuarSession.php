<?php
/**
 * Created by PhpStorm.
 * User: 2DAW17
 * Date: 03/12/2018
 * Time: 8:50
 */
session_start();
if (isset($_SESSION['idUsuario'])){
$idUsuario=$_SESSION['idUsuario'];
$correo=$_SESSION['usu_correo'];
$nombre=$_SESSION['usu_nombre'];
$perfil=$_SESSION['usu_perfil'];
}
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
    <?php include("header.php");?>
</div>
<div ID="izquierdo">

    <?php include("menu.php");?>

</div>
<div id="derecho">
	<?php
	echo $idUsuario;
	echo '<br/>';
	echo $correo;
	echo '<br/>';
	echo $nombre;
	echo '<br/>';
	echo $perfil;
	?>
</div>
</body>
</html>
