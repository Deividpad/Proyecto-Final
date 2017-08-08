<?php

/**
 * Created by PhpStorm.
 * User: yeimy
 * Date: 10/07/2017
 * Time: 12:16 PM
 */

require_once('db_abstract_class.php');

class Tiquete extends db_abstract_class
{
    private $idTiquete;
    private $Clase;
    private $Numero_Asiento;
    private $Valor;
    private $Estado;
    private $Pasajero_idPasajero;
    private $Vuelo_idVuelo;
    private $Combo_idcombo;

    public function __construct($persona_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($persona_data)>1){ //
            foreach ($persona_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idTiquete = "";
            $this->Clase = "";
            $this->Numero_Asiento = "";
            $this->Valor = "";
            $this->Estado = "";
            $this->Pasajero_idPasajero = "";
            $this->Vuelo_idVuelo = "";
            $this->Combo_idcombo = "";

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
    public function getIdTiquete()
    {
        return $this->idTiquete;
    }

    /**
     * @param string $idTiquete
     */
    public function setIdTiquete($idTiquete)
    {
        $this->idTiquete = $idTiquete;
    }

    /**
     * @return string
     */
    public function getClase()
    {
        return $this->Clase;
    }

    /**
     * @param string $Clase
     */
    public function setClase($Clase)
    {
        $this->Clase = $Clase;
    }

    /**
     * @return string
     */
    public function getNumeroAsiento()
    {
        return $this->Numero_Asiento;
    }

    /**
     * @param string $Numero_Asiento
     */
    public function setNumeroAsiento($Numero_Asiento)
    {
        $this->Numero_Asiento = $Numero_Asiento;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->Valor;
    }

    /**
     * @param string $Valor
     */
    public function setValor($Valor)
    {
        $this->Valor = $Valor;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    /**
     * @return string
     */
    public function getPasajeroIdPasajero()
    {
        return $this->Pasajero_idPasajero;
    }

    /**
     * @param string $Pasajero_idPasajero
     */
    public function setPasajeroIdPasajero($Pasajero_idPasajero)
    {
        $this->Pasajero_idPasajero = $Pasajero_idPasajero;
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

    /**
     * @return string
     */
    public function getComboIdcombo()
    {
        return $this->Combo_idcombo;
    }

    /**
     * @param string $Combo_idcombo
     */
    public function setComboIdcombo($Combo_idcombo)
    {
        $this->Combo_idcombo = $Combo_idcombo;
    }

  

    protected static function buscar($query)
    {
        // TODO: Implement buscar() method.
    }

    protected static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public static function buscarid($query)
    {
        $tmp = new Tiquete();
        $getrows = $tmp->getRows($query);
        $id = 0;
        foreach ($getrows as $valor) {
            $id = $valor['MAX(idTiquete)'];
        }

        $tmp->Disconnect();
        return $id;
    }

    public static function getid()
    {
        return Tiquete::buscarid("SELECT MAX(idTiquete) FROM tiquete");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.tiquete VALUES (NULL, ?,?,?,?,?,?,?)", array(

                $this->Clase,
                $this->Numero_Asiento,
                $this->Valor,
                $this->Estado,
                $this->Pasajero_idPasajero,
                $this->Vuelo_idVuelo,
                $this->Combo_idCombo,

            )
        );
        $this->Disconnect();
    }

    protected function editar()
    {
        // TODO: Implement editar() method.
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }


    public static function buscarForId($id)
    {
        $tiquete = new Tiquete();
        if ($id > 0) {
            $getrow = $tiquete->getRow("SELECT * FROM tiquete WHERE idTiquete =?", array($id));
            $tiquete->idTiquete = $getrow['idTiquete'];
            $tiquete->Clase = $getrow['Clase'];
            $tiquete->Numero_Asiento = $getrow['Numero_Asiento'];
            $tiquete->Valor = $getrow['Valor'];
            $tiquete->Estado = $getrow['Estado'];
            $tiquete->Pasajero_idPasajero = $getrow['Pasajero_idPasajero'];
            $tiquete->Vuelo_idVuelo = $getrow['Vuelo_idVuelo'];
            //$tiquete->Combo_idcombo = $getrow['Combo_idcombo'];
            $tiquete->Disconnect();
            return $tiquete;
        } else {
            return NULL;
        }
    }

}