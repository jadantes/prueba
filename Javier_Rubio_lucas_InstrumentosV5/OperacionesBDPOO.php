<?php
/**
 * Created by PhpStorm.
 * User: 2DAW17
 * Date: 29/11/2018
 * Time: 8:21
 */
require_once 'conf.php';

class OperacionesBDPOO
{
    public $resultado;
    private $mysqlConection;


    public function __construct()
    {
        $this->mysqlConection = new mysqli(host, user, pass, bd);
        $this->getConexionError();
    }


    public function getSingleQuery($sql)
    {
        //return $this->result=mysqli_query($this->mysqlConecction, $sql);
        $this->resultado = $this->mysqlConection->query($sql);

    }

    public function getFila()
    {
        return $this->resultado->fetch_array();
    }

    public function getConexionError()
    {
        $error = $this->mysqlConection->connect_error;
        echo $error;
    }

    public function getNumRow()
    {
        return $this->resultado->num_rows;
    }

    public function getMultiQuery($sql)
    {
        return $this->result = $this->mysqlConection->multi_query($sql);
    }

    public function getAfecctedRow()
    {
        return $this->resultado->affected_rows;

    }

    public function cerrarConexion()
    {
        mysqli_close($this->mysqlConection);
    }

    public function getErroNum()
    {
        return $this->mysqlConection->errno;


    }

    public function ultimoId()
    {
        return mysqli_insert_id($this->mysqlConection);
    }
   /* public function liberarMemoria(){
    	$this->mysqli_free_result($this->result);
	}*/

}