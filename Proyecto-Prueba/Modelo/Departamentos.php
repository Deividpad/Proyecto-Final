<?php
require_once('db_abstract_class.php');

/**
 * Created by PhpStorm.
 * User: Equipo13
 * Date: 25/07/2017
 * Time: 14:06
 */
class Departamentos extends db_abstract_class
{
   private $idDepartamentos;
   private $Departamentos;

    public function __construct($departamentos_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($departamentos_data)>1){ //
            foreach ($departamentos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idDepartamentos = "";
            $this->Departamentos = "";

        }
    }
    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    public static function buscarForId($id)
    {
        $departamentos = new Departamentos();
        if ($id > 0) {
            $getrow = $departamentos->getRow("SELECT * FROM departamentos WHERE idDepartamentos =?", array($id));
            $departamentos->idDepartamentos = $getrow['idDepartamentos'];
            $departamentos->Departamentos = $getrow['Departamentos'];
            $departamentos->Disconnect();
            return $departamentos;
        } else {
            return NULL;
        }
    }


    public static function buscar($query)
    {
        $arrayDepartamentos = array();
        $tmp = new departamentos();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $departamentos = new departamentos();
            $departamentos->idDepartamentos = $valor['idDepartamentos'];
            $departamentos->Departamentos = $valor['Departamentos'];
            array_push($arrayDepartamentos, $departamentos);
        }
        $tmp->Disconnect();
        return $arrayDepartamentos;
    }


    public static function getAll()
    {
        return departamentos::buscar("SELECT * FROM departamentos");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.departamentos VALUES (NULL, ?)", array(

                $this->Departamentos,

            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        $this->updateRow("UPDATE ciudades.idCiudades SET Ciudad = ? WHERE idCuidades = ?", array(

            $this->Departamentos,

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
    public function getIdDepartamentos()
    {
        return $this->idDepartamentos;
    }

    /**
     * @param string $idDepartamentos
     */
    public function setIdDepartamentos($idDepartamentos)
    {
        $this->idDepartamentos = $idDepartamentos;
    }

    /**
     * @return string
     */
    public function getDepartamentos()
    {
        return $this->Departamentos;
    }

    /**
     * @param string $Departamentos
     */
    public function setDepartamentos($Departamentos)
    {
        $this->Departamentos = $Departamentos;
    }




}