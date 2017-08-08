    <?php

require_once('db_abstract_class.php');

class avion extends db_abstract_class
{
    private $idAvion;
    Private $Nombre;
    private $Modelo;
    private $Tiempo_Vuelo;
    private $Capacidad_Silla;
    private $Asiento_Negocios_Fin;
    private $Estado;
    private $Aerolinea_idAerolinea;

    public function __construct($avion_data = array())
    {

        parent::__construct();
        if (count($avion_data) > 1) { //
            foreach ($avion_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->idAvion = "";
            $this->Nombre = "";
            $this->Modelo = "";
            $this->Tiempo_Vuelo = "";
            $this->Capacidad_Silla = "";
            $this->Asiento_Negocios_Fin = "";
            $this->Aerolinea_idAerolinea = "";
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
        $avion = new avion();
        if ($id > 0) {
            $getrow = $avion->getRow("SELECT * FROM avion WHERE idAvion =?", array($id));
            $avion->idAvion = $getrow['idAvion'];
            $avion->Nombre = $getrow['Nombre'];
            $avion->Modelo = $getrow['Modelo'];
            $avion->Tiempo_Vuelo = $getrow['Tiempo_Vuelo'];
            $avion->Capacidad_Silla = $getrow['Capacidad_Silla'];
            $avion->Asiento_Negocios_Fin = $getrow['Asiento_Negocios_Fin'];
            $avion->Aerolinea_idAerolinea = $getrow['Aerolinea_idAerolinea'];
            $avion->Estado = $getrow['Estado'];
            $avion->Disconnect();
            return $avion;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arravion = array();
        $tmp = new avion();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $avion = new avion();
            $avion->idAvion = $valor['idAvion'];
            $avion->Nombre = $valor['Nombre'];
            $avion->Modelo = $valor['Modelo'];
            $avion->Tiempo_Vuelo = $valor['Tiempo_Vuelo'];
            $avion->Capacidad_Silla = $valor['Capacidad_Silla'];
            $avion->Estado = $valor['Estado'];
            $avion->Aerolinea_idAerolinea = $valor['Aerolinea_idAerolinea'];
            array_push($arravion, $avion);
        }
        $tmp->Disconnect();
        return $arravion;
    }

    public static function getAll()
    {
        return avion::buscar("SELECT * FROM avion");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.avion VALUES (NULL, ?,?,?,?,?,?,?)", array(

                $this->Nombre,
                $this->Modelo,
                $this->Tiempo_Vuelo,
                $this->Capacidad_Silla,
                $this->Asiento_Negocios_Fin,
                $this->Aerolinea_idAerolinea,
                $this->Estado,

            )
        );
        $this->Disconnect();
    }

    public function editar()
    {

        $arrUser = (array) $this;
        $this->updateRow("UPDATE aerolinea.avion SET Nombre = ?, Modelo = ?, Tiempo_Vuelo = ?,
         Capacidad_Silla = ?, Asiento_Negocios_Fin = ?, Aerolinea_idAerolinea = ?, Estado = ?WHERE idAvion = ?", array(

            $this->Nombre,
            $this->Modelo,
            $this->Tiempo_Vuelo,
            $this->Capacidad_Silla,
            $this->Asiento_Negocios_Fin,
            $this->Aerolinea_idAerolinea,
            $this->Estado,
            $this->idAvion,
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
    public function getidAvion()
    {
        return $this->idAvion;
    }

    /**
     * @param string $idAvion
     */
    public function setidAvion($idAvion)
    {
        $this->idAvion = $idAvion;
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
    public function getModelo()
    {
        return $this->Modelo;
    }

    /**
     * @param string $Modelo
     */
    public function setModelo($Modelo)
    {
        $this->Modelo = $Modelo;
    }

    /**
     * @return string
     */
    public function getTiempoVuelo()
    {
        return $this->Tiempo_Vuelo;
    }

    /**
     * @param string $Tiempo_Vuelo
     */
    public function setTiempoVuelo($Tiempo_Vuelo)
    {
        $this->Tiempo_Vuelo = $Tiempo_Vuelo;
    }

    /**
     * @return string
     */
    public function getCapacidadSilla()
    {
        return $this->Capacidad_Silla;
    }

    /**
     * @param string $Capacidad_Silla
     */
    public function setCapacidadSilla($Capacidad_Silla)
    {
        $this->Capacidad_Silla = $Capacidad_Silla;
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
     * @return mixed
     */
    public function getAerolineaIdAerolinea()
    {
        return $this->Aerolinea_idAerolinea;
    }

    /**
     * @param mixed $Aerolinea_idAerolinea
     */
    public function setAerolineaIdAerolinea($Aerolinea_idAerolinea)
    {
        $this->Aerolinea_idAerolinea = $Aerolinea_idAerolinea;
    }

    /**
     * @return string
     */
    public function getAsientoNegociosFin()
    {
        return $this->Asiento_Negocios_Fin;
    }

    /**
     * @param string $Asiento_Negocios_Fin
     */
    public function setAsientoNegociosFin($Asiento_Negocios_Fin)
    {
        $this->Asiento_Negocios_Fin = $Asiento_Negocios_Fin;
    }



}