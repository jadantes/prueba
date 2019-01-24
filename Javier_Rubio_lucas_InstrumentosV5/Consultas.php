<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/12/2018
 * Time: 21:02
 */

class Consultas
{
// tengo que hacer otro metodo para controlar si se ha insertado o no y gestionarlo desde aqui!!

    public function comprobarError($error)
    {
        if($error==1062){
            $mensaje="ya existe ese nombre";
        }
        elseif($error=='noImage'){
            $mensaje="No es una imagen valida";
        }
        elseif($error==1064) {
            $mensaje="tienes un error de sintasis";
        }
        elseif($error==1054) {
            $mensaje="el precio tiene que ser decimal";
        }
        else{
            $mensaje = "la causa tecnica del error es" . $error;
        }
        return $mensaje;
    }
		
		function generateRandomString($length = 5) {
			return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}
		
	}