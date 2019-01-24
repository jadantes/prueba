

	<?php
		require_once "OperacionesBDPOO.php";
		require_once "Consultas.php";
		$con = new OperacionesBDPOO();
		$metodos = new Consultas();
	
		$tipos=['Cuerda','Viento','Viento-Metal','Percusion','Elctronicas'];
		for($i=0;$i<5;$i++){
			$nombre="'".$tipos[$i]."'";
			$sql = "insert into tipos (tip_nombre) values ($nombre)";
	        $con->getSingleQuery($sql);
		}
		
		
		$instrumentos=['Guitarra','Violin','Flauta','F.Clarinete','Travesera','Trompeta','Piano','Tambor','G.Electrica','MesaDJ'];
		$a=1;
		for($i=0;$i<10;$i++){
			$nombre="'".$instrumentos[$i]."'";
			//$id= rand(0, 4);
			$sql = "insert into instrumentos (ins_nombre,ins_tipo_id) values ($nombre,$a)";
			$con->getSingleQuery($sql);
			if($i%2){
				$a++;
			}
		}
		
		$fotos=['guitarra.png','trompeta.png'];
		$a=1;
		for($i=0;$i<20;$i++){
			$referencia="'".$metodos->generateRandomString()."'";
			$nombre="'modelo".$i."'";
			$descripcion="'descripcion'";
			$precio=rand(0,100);
			$existencia=rand(0,100);
			$descuento=rand(0,100);
			if($i%2){
				$foto="'guitarra.png'";
			}
			else{
				$foto="'trompeta.jpg'";
			}
			$mod_id_instrumento=rand(0,10);
			$sql = "insert into modelos(id_modelo,mod_nombre,mod_descripcion,mod_precio,mod_existencia,mod_descuento,mod_id_instrumento,mod_ruta) values($referencia,$nombre,$descripcion,$precio,$existencia,$descuento,$mod_id_instrumento,$foto)";
			echo $sql;
			$con->getSingleQuery($sql);
	}

header("location:index.php");
