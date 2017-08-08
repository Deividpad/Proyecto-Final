<?php
require_once('db_abstract_class.php');

class personal_has_vuelo extends db_abstract_class
{
    private $Personal_idPersonal;
    Private $Vuelo_idVuelo;


    public function __construct($tickete_data = array())
    {

        parent::__construct();
        if (count($tickete_data) > 1) { //
            foreach ($tickete_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Personal_idPersonal = "";
            $this->Vuelo_idVuelo = "";
        }
    }




    function __destruct()
    {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $vuelo = new personal_has_vuelo();
        if ($id > 0) {
            $getrow = $vuelo->getRow("SELECT * FROM  WHERE idVuelo =?", array($id));
            $vuelo->Personal_idPersonal = $getrow['Personal_idPersonal'];
            $vuelo->Vuelo_idVuelo = $getrow['Vuelo_idVuelo'];

            $vuelo->Disconnect();
            return $vuelo;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $rraypersonalvuelo = array();
        $tmp = new personal_has_vuelo();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $personalvuelo = new personal_has_vuelo();
            $personalvuelo->Personal_idPersonal = $valor['Personal_idPersonal'];
            $personalvuelo->Vuelo_idVuelo = $valor['Vuelo_idVuelo'];


            array_push($rraypersonalvuelo, $personalvuelo);
        }
        $tmp->Disconnect();
        return $rraypersonalvuelo;
    }

    public static function isPersonal($IdVuelo)
    {
        $tmp = new personal_has_vuelo();
        $getrows = $tmp->getRows("SELECT * FROM personal_has_vuelo WHERE Vuelo_idVuelo =".$IdVuelo."");
        $cont =0;
        foreach ($getrows as $valor){
            $cont++;
        }
        //$IsFree = (count($getrows) > 0) ? true : false ;
        $tmp->Disconnect();
        return $cont;
    }


    public static function PersonalnoRepeat($IdVuelo, $idpersonal)
    {
        $tmp = new personal_has_vuelo();
        $getrows = $tmp->getRows("SELECT * FROM personal_has_vuelo WHERE Vuelo_idVuelo =".$IdVuelo." AND Personal_idPersonal = ".$idpersonal."");
        $IsFree = (count($getrows) > 0) ? false : true ;
        $tmp->Disconnect();
        return $IsFree;
    }

    public static function VueloPersona($IdVuelo)
    {
        if($IdVuelo >=1) {
            $rraypersonalvuelo = array();
            $tmp = new personal_has_vuelo();
            $getrows = $tmp->getRows("SELECT * FROM personal_has_vuelo WHERE Vuelo_idVuelo =" . $IdVuelo . "");
            //$IsFree = (count($getrows) > 0) ? false : true ;
            foreach ($getrows as $valor) {
                array_push($rraypersonalvuelo, $valor['Personal_idPersonal']);
            }
            $tmp->Disconnect();
            return $rraypersonalvuelo;
        }else{
            return NULL;
        }
    }


    public static function getAll()
    {
        return AsientosTickete::buscar2("SELECT * FROM asientosTickete");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.personal_has_vuelo VALUES (?,?)", array(
                $this->Personal_idPersonal,
                $this->Vuelo_idVuelo,
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
     * @return string
     */
    public function getPersonalIdPersonal()
    {
        return $this->Personal_idPersonal;
    }

    /**
     * @param string $Personal_idPersonal
     */
    public function setPersonalIdPersonal($Personal_idPersonal)
    {
        $this->Personal_idPersonal = $Personal_idPersonal;
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




}