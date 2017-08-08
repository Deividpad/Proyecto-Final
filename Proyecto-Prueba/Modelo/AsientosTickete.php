<?php
require_once('db_abstract_class.php');

class AsientosTickete extends db_abstract_class
{
    private $Vuelo_idVuelo;
    Private $Tiquete_idTiquete;
    private $NAsiento;
    private $Clase;


    public function __construct($tickete_data = array())
    {

        parent::__construct();
        if (count($tickete_data) > 1) { //
            foreach ($tickete_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Vuelo_idVuelo = "";
            $this->Tiquete_idTiquete = "";
            $this->NAsiento = "";
            $this->Clase = "";
        }
    }




    function __destruct()
    {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $vuelo = new AsientosTickete();
        if ($id > 0) {
            $getrow = $vuelo->getRow("SELECT * FROM  WHERE idVuelo =?", array($id));
            $vuelo->Vuelo_idVuelo = $getrow['Vuelo_idVuelo'];
            $vuelo->Tiquete_idTiquete = $getrow['Tiquete_idTiquete'];
            $vuelo->NAsiento = $getrow['NAsiento'];
            $vuelo->Clase = $getrow['Clase'];
            $vuelo->Disconnect();
            return $vuelo;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrayTickete = array();
        $tmp = new AsientosTickete();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $tickete = new AsientosTickete();
            $tickete->Vuelo_idVuelo = $valor['Vuelo_idVuelo'];
            $tickete->Tiquete_idTiquete = $valor['Tiquete_idTiquete'];
            $tickete->NAsiento = $valor['NAsiento'];
            $tickete->Clase = $valor['Clase'];
            array_push($arrayTickete, $tickete);
        }
        $tmp->Disconnect();
        return $arrayTickete;
    }

    public static function isFreeTicket($IdVuelo, $NAsiento)
    {
        $tmp = new AsientosTickete();
        $getrows = $tmp->getRows("SELECT * FROM asientostickete WHERE Vuelo_idVuelo =".$IdVuelo." AND NAsiento = ".$NAsiento."");
        $IsFree = (count($getrows) > 0) ? false : true ;
        $tmp->Disconnect();
        return $IsFree;
    }


    public static function getAll()
    {
        return AsientosTickete::buscar("SELECT * FROM asientosTickete");
    }

    public static function getAllPuestosVuelos($Vuelo)
    {
        $arrayTickete = array();
        $tmp = new AsientosTickete();
        $getrows = $tmp->getRows("SELECT * FROM asientosTickete WHERE Vuelo_idVuelo = ?",array($Vuelo));

        foreach ($getrows as $valor) {
            $tickete = new AsientosTickete();
            $tickete->Vuelo_idVuelo = $valor['Vuelo_idVuelo'];
            $tickete->Tiquete_idTiquete = $valor['Tiquete_idTiquete'];
            $tickete->NAsiento = $valor['NAsiento'];
            $tickete->Clase = $valor['Clase'];
            array_push($arrayTickete, $tickete);
        }

        $tmp->Disconnect();
        return $arrayTickete;
    }

        public static function TiqueteAsientos2($Tiquete)
    {
        $arrayTickete = array();
        $tmp = new AsientosTickete();
        $getrows = $tmp->getRows("SELECT * FROM asientosTickete WHERE Tiquete_idTiquete = ?",array($Tiquete));
        $cont =0;
        foreach ($getrows as $val){
            $cont++;
        }
        if($cont ==1){
        foreach ($getrows as $valor) {
            $tickete = new AsientosTickete();
            //$tickete->Vuelo_idVuelo = $valor['Vuelo_idVuelo'];
            //$tickete->Tiquete_idTiquete = $valor['Tiquete_idTiquete'];
            $tickete->NAsiento = $valor['NAsiento'];
            $asiento = $tickete->NAsiento = $valor['NAsiento'];
            //$tickete->Clase = $valor['Clase'];
            array_push($arrayTickete, $tickete);
        }
        }

        $tmp->Disconnect();
        return $asiento;
    }
    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.asientostickete VALUES (?,?,?,?)", array(

                $this->Vuelo_idVuelo,
                $this->Tiquete_idTiquete,
                $this->NAsiento,
                $this->Clase,

            )
        );
        $this->Disconnect();
    }


    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }


    protected function editar()
    {
        // TODO: Implement editar() method.
    }


    /**
     * @return mixed
     */
    public function getVueloIdVuelo()
    {
        return $this->Vuelo_idVuelo;
    }

    /**
     * @param mixed $Vuelo_idVuelo
     */
    public function setVueloIdVuelo($Vuelo_idVuelo)
    {
        $this->Vuelo_idVuelo = $Vuelo_idVuelo;
    }

    /**
     * @return mixed
     */
    public function getTiqueteIdTiquete()
    {
        return $this->Tiquete_idTiquete;
    }

    /**
     * @param mixed $Tiquete_idTiquete
     */
    public function setTiqueteIdTiquete($Tiquete_idTiquete)
    {
        $this->Tiquete_idTiquete = $Tiquete_idTiquete;
    }

    /**
     * @return mixed
     */
    public function getNAsiento()
    {
        return $this->NAsiento;
    }

    /**
     * @param mixed $NAsiento
     */
    public function setNAsiento($NAsiento)
    {
        $this->NAsiento = $NAsiento;
    }

    /**
     * @return mixed
     */
    public function getClase()
    {
        return $this->Clase;
    }

    /**
     * @param mixed $Clase
     */
    public function setClase($Clase)
    {
        $this->Clase = $Clase;
    }

}