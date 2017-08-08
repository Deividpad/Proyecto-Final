<?php

/**
 * Created by PhpStorm.
 * User: yeimy
 * Date: 10/07/2017
 * Time: 12:05 PM
 */
require_once('db_abstract_class.php');

class Combo extends db_abstract_class
{
    private $idCombo;
    private $Ninos;
    private $Adultos;
    private $Fecha_Ida;
    private $Fecha_Vuelta;
    private $Precio;
    private $Vuelo_idVuelo;

    public function __construct($persona_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($persona_data)>1){ //
            foreach ($persona_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idCombo = "";
            $this->Ninos = "";
            $this->Adultos = "";
            $this->Fecha_Ida = "";
            $this->Fecha_Vuelta = "";
            $this->Precio = "";
            $this->Vuelo_idVuelo = "";

        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return string
     */
    public function getIdCombo()
    {
        return $this->idCombo;
    }

    /**
     * @param string $idCombo
     */
    public function setIdCombo($idCombo)
    {
        $this->idCombo = $idCombo;
    }

    /**
     * @return string
     */
    public function getNinos()
    {
        return $this->Ninos;
    }

    /**
     * @param string $Ninos
     */
    public function setNinos($Ninos)
    {
        $this->Ninos = $Ninos;
    }

    /**
     * @return string
     */
    public function getAdultos()
    {
        return $this->Adultos;
    }

    /**
     * @param string $Adultos
     */
    public function setAdultos($Adultos)
    {
        $this->Adultos = $Adultos;
    }

    /**
     * @return string
     */
    public function getFechaIda()
    {
        return $this->Fecha_Ida;
    }

    /**
     * @param string $Fecha_Ida
     */
    public function setFechaIda($Fecha_Ida)
    {
        $this->Fecha_Ida = $Fecha_Ida;
    }

    /**
     * @return string
     */
    public function getFechaVuelta()
    {
        return $this->Fecha_Vuelta;
    }

    /**
     * @param string $Fecha_Vuelta
     */
    public function setFechaVuelta($Fecha_Vuelta)
    {
        $this->Fecha_Vuelta = $Fecha_Vuelta;
    }

    /**
     * @return string
     */
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * @param string $Precio
     */
    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;
    }

    /**
     * @return string
     */
    public function getVueloIdVuelo()
    {
        return $this->Vuelo_idVuelo;
    }

    /**
     * @param string $Vuelo_idVuelo
     */
    public function setVueloIdVuelo($Vuelo_idVuelo)
    {
        $this->Vuelo_idVuelo = $Vuelo_idVuelo;
    }

    public static function buscarForId($id)
    {
        // TODO: Implement buscarForId() method.
    }

    public static function buscar($query)
    {
        // TODO: Implement buscar() method.
    }

    public static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.combo VALUES (NULL, ?,?,?,?,?,?)", array(

                $this->Ninos,
                $this->Adultos,
                $this->Fecha_Ida,
                $this->Fecha_Vuelta,
                $this->Precio,
                $this->Vuelo_idVuelo,

            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        // TODO: Implement editar() method.
    }

    public function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }


}