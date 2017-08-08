<?php

require_once('db_abstract_class.php');

class Clientes extends db_abstract_class
{
    private $idPasajero;
    private $Tipo_Documento;
    private $Documento;
    private $Nombre;
    private $Apellido;
    private $Telefono;
    private $Direccion;


    public function __construct($persona_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($persona_data)>1){ //
            foreach ($persona_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idPasajero = "";
            $this->Tipo_Documento = "";
            $this->Documento = "";
            $this->Nombre = "";
            $this->Apellido = "";
            $this->Telefono = "";
            $this->Direccion = "";

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
    public function getIdPasajero()
    {
        return $this->idPasajero;
    }

    /**
     * @param string $idPasajero
     */
    public function setIdPasajero($idPasajero)
    {
        $this->idPasajero = $idPasajero;
    }

    /**
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->Tipo_Documento;
    }

    /**
     * @param string $Tipo_Documento
     */
    public function setTipoDocumento($Tipo_Documento)
    {
        $this->Tipo_Documento = $Tipo_Documento;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->Documento;
    }

    /**
     * @param string $Documento
     */
    public function setDocumento($Documento)
    {
        $this->Documento = $Documento;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * @param string $Apellido
     */
    public function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param string $Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param string $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }

    public static function buscarForId($id)
    {

        $clientes = new Clientes();
        if ($id > 0) {
            $getrow = $clientes->getRow("SELECT * FROM pasajero WHERE idPasajero =?", array($id));
            $clientes->idPasajero = $getrow['idPasajero'];
            $clientes->Tipo_Documento = $getrow['Tipo_Documento'];
            $clientes->Documento = $getrow['Documento'];
            $clientes->Nombre = $getrow['Nombre'];
            $clientes->Apellido = $getrow['Apellido'];
            $clientes->Telefono = $getrow['Telefono'];
            $clientes->Direccion = $getrow['Direccion'];
            $clientes->Disconnect();
            return $clientes;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrayclientes = array();
        $tmp = new Clientes();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $cliente = new Clientes();
            $cliente->idPasajero = $valor['idPasajero'];
            $cliente->Tipo_Documento = $valor['Tipo_Documento'];
            $cliente->Documento = $valor['Documento'];
            $cliente->Nombre = $valor['Nombre'];
            $cliente->Apellido = $valor['Apellido'];
            $cliente->Telefono = $valor['Telefono'];
            $cliente->Direccion= $valor['Direccion'];
            array_push($arrayclientes, $cliente);
        }
        $tmp->Disconnect();
        return $arrayclientes;
    }

    public static function buscarid($query)
    {
        $tmp = new Clientes();
        $getrows = $tmp->getRows($query);
        $id = 0;
        foreach ($getrows as $valor) {
            $id = $valor['MAX(idPasajero)'];
        }

        $tmp->Disconnect();
        return $id;
    }

    public static function getAll()
    {
        return Clientes::buscar("SELECT * FROM pasajero");
    }

    public static function getid()
    {
        return Clientes::buscarid("SELECT MAX(idPasajero) FROM pasajero");
    }

    public function insertar()
    {
         $this->insertRow("INSERT INTO aerolinea.pasajero VALUES (NULL, ?,?,?,?,?,?) ", array(
                $this->Tipo_Documento,
                $this->Documento,
                $this->Nombre,
                $this->Apellido,
                $this->Telefono,
                $this->Direccion,
            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        $arrUser = (array) $this;
        $this->updateRow("UPDATE aerolinea.pasajero SET Tipo_Documento = ?, Documento = ?, Nombre = ?, Apellido = ?, Telefono = ?, Direccion = ? WHERE idPasajero = ?", array(
            $this->Tipo_Documento,
            $this->Documento,
            $this->Nombre,
            $this->Apellido,
            $this->Telefono,
            $this->Direccion,
            $this->idPasajero,
        ));
        $this->Disconnect();
    }

    public function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }



}