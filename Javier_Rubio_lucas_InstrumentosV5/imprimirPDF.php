<?php

define('FPDF_FONTPATH', 'fpdf181/font/');
require('fpdf181/fpdf.php');
require_once('OperacionesBDPOO.php');

$con = new OperacionesBDPOO();
$sql = "select ins_nombre,id_instrumento,id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_existencia,mod_id_instrumento from instrumentos inner join modelos on instrumentos.id_instrumento=modelos.mod_id_instrumento order by modelos.mod_id_instrumento;";
//$sql = "select * from instrumentos";

$con->getSingleQuery($sql);
	
	$pdf = new FPDF();
	$tamanio = ($pdf->GetPageWidth() - 20) / 6;
	$fila = $con->getFila();
	$cond=true;
	
while ($cond) {
	$idInstrumento=$fila['id_instrumento'];
	$pdf->AddPage();
	$pdf->setFillColor(255, 0, 00);
	$pdf->SetFont('Arial', 'B', 20);
	
	$pdf->Cell(0, 10, $fila["ins_nombre"], 0, 1, 'C');
	$pdf->SetFont('Arial', 'BI', 16);
	$pdf->Ln();
	
	$pdf->SetFont('Arial', 'B', 13);
	$pdf->Cell($tamanio, 10, 'Id_Modelo', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Nombre', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Descripcion', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Precio', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Existencia', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'id_instrumento', 0, 1, 'C');
	while($idInstrumento == $fila["id_instrumento"]){
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($tamanio, 10, $fila['id_modelo'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_nombre'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_descripcion'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_precio'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_existencia'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_id_instrumento'], 0, 1, 'C');
		if($fila = $con->getFila()){
			if($fila["id_instrumento"]!=$idInstrumento){
				break;
			}
		}
		else{
			$cond=false;
		}
	}
}

/*$pdf = new FPDF();
foreach ($idInstrumentos as $idIns => $insNombre) {

	$pdf->AddPage();

	$sql = "select * from modelos where mod_id_instrumento =" . $idIns;

	$con->getSingleQuery($sql);

	$tamanio = ($pdf->GetPageWidth() - 20) / 6;

	$pdf->setFillColor(255, 0, 00);
	$pdf->SetFont('Arial', 'B', 20);

	$pdf->Cell(0, 10, $insNombre, 0, 1, 'C');
	$pdf->SetFont('Arial', 'BI', 16);
	$pdf->Ln();
	$pdf->SetFont('Arial', 'B', 13);
	$pdf->Cell($tamanio, 10, 'Id_Modelo', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Nombre', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Descripcion', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Precio', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'Existencia', 0, 0, 'C');
	$pdf->Cell($tamanio, 10, 'id_instrumento', 0, 1, 'C');
	while ($fila = $con->getFila()) {
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($tamanio, 10, $fila['id_modelo'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_nombre'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_descripcion'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_precio'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_existencia'], 0, 0, 'C');
		$pdf->Cell($tamanio, 10, $fila['mod_id_instrumento'], 0, 1, 'C');
	}
*/

$pdf->Output();
?>