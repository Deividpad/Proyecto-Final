<?php

require_once('db_abstract_class.php');

class aerolinea extends db_abstract_class
{
    private $idAerolinea;
    Private $Razon_Social;
    private $Nit;
    private $Direccion;
    private $Correo;
    private $Telefono;
    private $Estado;



    public function __construct($aerolinea_data = array())
    {

        parent::__construct();
        if (count($aerolinea_data) > 1) { //
            foreach ($aerolinea_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->idAerolinea = "";
            $this->Razon_Social = "";
            $this->Nit = "";
            $this->Direccion = "";
            $this->Correo = "";
            $this->Telefono = "";
            $this->Estado = "";
        }
    }

    function __destruct()
    {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $Aerolinea = new aerolinea();
        if ($id > 0) {
            $getrow = $Aerolinea->getRow("SELECT * FROM aerolinea WHERE idAerolinea = ?", array($id));
            $Aerolinea->idAerolinea = $getrow['idAerolinea'];
            $Aerolinea->Razon_Social = $getrow['Razon_Social'];
            $Aerolinea->Nit = $getrow['Nit'];
            $Aerolinea->Direccion = $getrow['Direccion'];
            $Aerolinea->Correo = $getrow['Correo'];
            $Aerolinea->Telefono = $getrow['Telefono'];
            $Aerolinea->Estado = $getrow['Estado'];
            $Aerolinea->Disconnect();
            return $Aerolinea;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrayAerolinea = array();
        $tmp = new aerolinea();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Aerolinea = new aerolinea();
            $Aerolinea->idAerolinea = $valor['idAerolinea'];
            $Aerolinea->Razon_Social = $valor['Razon_Social'];
            $Aerolinea->Nit = $valor['Nit'];
            $Aerolinea->Direccion = $valor['Direccion'];
            $Aerolinea->Correo = $valor['Correo'];
            $Aerolinea->Telefono = $valor['Telefono'];
            $Aerolinea->Estado = $valor['Estado'];
            array_push($arrayAerolinea, $Aerolinea);
        }
        $tmp->Disconnect();
        return $arrayAerolinea;
    }

    public static function getAll()
    {
        return aerolinea::buscar("SELECT * FROM aerolinea");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.aerolinea VALUES (NULL, ?,?,?,?,?,?)", array(

                $this->Razon_Social,
                $this->Nit,
                $this->Direccion,
                $this->Correo,
                $this->Telefono,
                $this->Estado,
            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        $arrUser = (array) $this;
        $this->updateRow("UPDATE aerolinea.aerolinea SET Razon_Social = ?, Nit = ?, Direccion = ?, Correo = ?, Telefono = ?, Estado = ? WHERE idAerolinea = ?", array(
            $this->Razon_Social,
            $this->Nit,
            $this->Direccion,
            $this->Correo,
            $this->Telefono,
            $this->Estado,
            $this->idAerolinea,
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }
    /**
     * @return string
     */
    public function getIdAerolinea()
    {
        return $this->idAerolinea;
    }

    /**
     * @param string $idAerolinea
     */
    public function setIdAerolinea($idAerolinea)
    {
        $this->idAerolinea = $idAerolinea;
    }

    /**
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->Razon_Social;
    }

    /**
     * @param string $Razon_Social
     */
    public function setRazonSocial($Razon_Social)
    {
        $this->Razon_Social = $Razon_Social;
    }

    /**
     * @return string
     */
    public function getNit()
    {
        return $this->Nit;
    }

    /**
     * @param string $Nit
     */
    public function setNit($Nit)
    {
        $this->Nit = $Nit;
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

    /**
     * @return string
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @param string $Correo
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
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



}