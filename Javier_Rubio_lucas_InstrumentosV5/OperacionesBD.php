<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 17/11/2018
 * Time: 11:16
 */

class OperacionesBD
{
    public $result;
    private $mysqlConecction;
    private $bd = "instrumentosweb";
    private $user = "root";
    private $pass = "";
    private $host = "localhost";

    /**
     * OperacionesBD constructor.
     */
    public function __construct()
    {
        $this->getConexion();
    }

    public function getFila()
    {
        return mysqli_fetch_array($this->result);
    }

    public function getConexion()
    {
        $this->mysqlConecction = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);

    }

    public function getSingleQuery($sql)
    {
        return $this->result=mysqli_query($this->mysqlConecction, $sql);
    }

    public function getMultiQuery($sql)
    {
        return $this->result=mysqli_multi_query($this->mysqlConecction, $sql);
    }

    public function getAfecctedRow()
    {
        return mysqli_affected_rows($this->mysqlConecction);

    }

    public function cerrarConexion()
    {
        mysqli_close($this->mysqlConecction);
    }

    public function numFilas(){
     //  return $this->result->num_rows();
     }

     public function ultimoId(){
         return mysqli_insert_id($this->mysqlConecctionttddc);
     }
}