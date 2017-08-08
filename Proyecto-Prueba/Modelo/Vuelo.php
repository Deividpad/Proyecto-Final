<?php
require_once('db_abstract_class.php');

class vuelo extends db_abstract_class
{
    private $idVuelo;
    Private $Fecha;
    private $Hora;
    private $Tipo;
    private $Estado;
    private $Avion_idAvion;
    private $Rutas_idRutas;


    public function __construct($vuelo_data = array())
    {

        parent::__construct();
        if (count($vuelo_data) > 1) { //
            foreach ($vuelo_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->idVuelo = "";
            $this->Fecha = "";
            $this->Hora = "";
            $this->Tipo = "";
            $this->Estado = "";
            $this->Avion_idAvion;
            $this->Rutas_idRutas;
        }
    }


    function __destruct()
    {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $vuelo = new vuelo();
        if ($id > 0) {
            $getrow = $vuelo->getRow("SELECT * FROM vuelo WHERE idVuelo =?", array($id));
            $vuelo->idVuelo = $getrow['idVuelo'];
            $vuelo->Fecha = $getrow['Fecha'];
            $vuelo->Hora = $getrow['Hora'];
            $vuelo->Tipo = $getrow['Tipo'];
            $vuelo->Avion_idAvion = $getrow['Avion_idAvion'];
            $vuelo->Rutas_idRutas = $getrow['Rutas_idRutas'];
            $vuelo->Estado = $getrow['Estado'];

            $vuelo->Disconnect();
            return $vuelo;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrayVuelo = array();
        $tmp = new vuelo();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $vuelo = new vuelo();
            $vuelo->idVuelo = $valor['idVuelo'];
            $vuelo->Fecha = $valor['Fecha'];
            $vuelo->Hora = $valor['Hora'];
            $vuelo->Tipo = $valor['Tipo'];
            $vuelo->Avion_idAvion = $valor['Avion_idAvion'];
            $vuelo->Rutas_idRutas = $valor['Rutas_idRutas'];
            $vuelo->Estado = $valor['Estado'];
            array_push($arrayVuelo, $vuelo);
        }
        $tmp->Disconnect();
        return $arrayVuelo;
    }



    public static function getAll()
    {
        return vuelo::buscar("SELECT * FROM vuelo");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.vuelo VALUES (NULL, ?,?,?,?,?,?)", array(
                $this->Fecha,
                $this->Hora,
                $this->Tipo,
                $this->Avion_idAvion,
                $this->Rutas_idRutas,
                $this->Estado,

            )
        );
        $this->Disconnect();
        //require("../Controlador/AvionController.php");
        //AvionController::DestinarAvion($this->Avion_idAvion);
    }

    public function editar()
    {
        $this->updateRow("UPDATE aerolinea.vuelo SET Fecha = ?, Hora = ?, Tipo = ?, Avion_idAvion = ?, Rutas_idRutas = ?, Estado = ? WHERE idVuelo = ?", array(

            $this->Fecha,
            $this->Hora,
            $this->Tipo,
            $this->Avion_idAvion,
            $this->Rutas_idRutas,
            $this->Estado,
            $this->idVuelo,

        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }

    /**
     * @return mixed
     */
    public function getidVuelo()
    {
        return $this->idVuelo;
    }

    /**
     * @param mixed $idVuelo
     */
    public function setidVuelo($idVuelo)
    {
        $this->idVuelo = $idVuelo;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $Fecha
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->Hora;
    }

    /**
     * @param mixed $Hora
     */
    public function setHora($Hora)
    {
        $this->Hora = $Hora;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @param string $Tipo
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    /**
     * @return mixed
     */
    public function getAvionIdAvion()
    {
        return $this->Avion_idAvion;
    }

    /**
     * @param mixed $Avion_idAvion
     */
    public function setAvionIdAvion($Avion_idAvion)
    {
        $this->Avion_idAvion = $Avion_idAvion;
    }

    /**
     * @return mixed
     */
    public function getRutasIdRutas()
    {
        return $this->Rutas_idRutas;
    }

    /**
     * @param mixed $Rutas_idRutas
     */
    public function setRutasIdRutas($Rutas_idRutas)
    {
        $this->Rutas_idRutas = $Rutas_idRutas;
    }
    
    
    
    
}