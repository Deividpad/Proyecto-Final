<?php

require_once('db_abstract_class.php');

class Ciudades extends db_abstract_class
{
    private $idCiudades;
    private $Ciudad;
    private $Departamentos_idDepartamentos;

    /**
     * @return mixed
     */


    public function __construct($ciudades_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($ciudades_data)>1){ //
            foreach ($ciudades_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idCiudades = "";
            $this->Ciudad = "";
            $this->Departamentos_idDepartamentos = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $ciudades = new Ciudades();
        if ($id > 0) {
            $getrow = $ciudades->getRow("SELECT * FROM ciudades WHERE idCiudades =?", array($id));
            $ciudades->idCiudades = $getrow['idCiudades'];
            $ciudades->Ciudad = $getrow['Ciudad'];
           // $ciudades->Departamentos_idDepartamentos = $getrow['Departamentos_idDepartamentos'];
            $ciudades->Disconnect();
            return $ciudades;
        } else {
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrayCiudades = array();
        $tmp = new ciudades();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $ciudades = new ciudades();
            $ciudades->idCiudades = $valor['idCiudades'];
            $ciudades->Ciudad = $valor['Ciudad'];
            $ciudades->Departamentos_idDepartamentos = $valor['Departamentos_idDepartamentos'];
            array_push($arrayCiudades, $ciudades);
        }
        $tmp->Disconnect();
        return $arrayCiudades;
    }

    public static function getAll()
    {
        return ciudades::buscar("SELECT * FROM ciudades");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.ciudades VALUES (NULL, ?,?)", array(

            $this->Ciudad,
            $this->Departamentos_idDepartamentos,
            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        $this->updateRow("UPDATE aerolinea.ciudades SET Ciudad = ?, Departamentos_idDepartamentos = ? WHERE idCiudades = ?", array(

            $this->Ciudad,
            $this->Departamentos_idDepartamentos,
            $this->idCiudades,

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
    public function getIdCiudades()
    {
        return $this->idCiudades;
    }

    /**
     * @param string $idCiudades
     */
    public function setIdCiudades($idCiudades)
    {
        $this->idCiudades = $idCiudades;
    }

    /**
     * @return string
     */
    //public function getDepartamento()
    //{
        //return $this->Departamento;
    //}

    /**
     * @param string $Departamento
     */
    //public function setDepartamento($Departamento)
    //{
      //  $this->Departamento = $Departamento;
    //}

    /**
     * @return string
     */
    public function getCiudad()
    {
        return $this->Ciudad;
    }

    /**
     * @param string $Ciudad
     */
    public function setCiudad($Ciudad)
    {
        $this->Ciudad = $Ciudad;
    }


    public function getDepartamentosIdDepartamentos()
    {
        return $this->Departamentos_idDepartamentos;
    }

    /**
     * @param mixed $Departamentos_idDepartamentos
     */
    public function setDepartamentosIdDepartamentos($Departamentos_idDepartamentos)
    {
        $this->Departamentos_idDepartamentos = $Departamentos_idDepartamentos;
    }

    /**
     * @return string
     */





}