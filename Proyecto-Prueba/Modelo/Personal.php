<?php
require_once('db_abstract_class.php');
/**
 * Created by PhpStorm.
 * User: yeimy
 * Date: 10/07/2017
 * Time: 12:29 PM
 */
class personal extends db_abstract_class
{

    private $idPersonal;
    private $Tipo_Documento;
    private $Documento;
    private $Nombre;
    private $Apellido;
    private $Telefono;
    private $Direccion;
    private $Correo;
    private $Cargo;
    private $Rh;
    private $Estado;

    public function __construct($personal_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($personal_data)>1){ //
            foreach ($personal_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idPersonal = "";
            $this->Tipo_Documento = "";
            $this->Documento = "";
            $this->Nombre = "";
            $this->Apellido = "";
            $this->Telefono = "";
            $this->Direccion = "";
            $this->Correo = "";
            $this->Cargo = "";
            $this->Rh = "";
            $this->Estado = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }
public static function buscarForId($id)
    {
        $personal = new personal();
        if ($id > 0) {
            $getrow = $personal->getRow("SELECT * FROM personal WHERE idPersonal = ?", array($id));
            $personal->idPersonal = $getrow['idPersonal'];
            $personal->Tipo_Documento = $getrow['Tipo_Documento'];
            $personal->Documento = $getrow['Documento'];
            $personal->Nombre = $getrow['Nombre'];
            $personal->Apellido = $getrow['Apellido'];
            $personal->Telefono = $getrow['Telefono'];
            $personal->Direccion = $getrow['Direccion'];
            $personal->Correo = $getrow['Correo'];
            $personal->Cargo = $getrow['Cargo'];
            $personal->Rh = $getrow['Rh'];
            $personal->Estado = $getrow['Estado'];
            $personal->Disconnect();
            return $personal;
        } else {
            return NULL;
        }
    }


    protected static function buscar($query)
    {
        $arraypersonal = array();
        $tmp = new personal();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $personal = new personal();
            $personal->idPersonal = $valor['idPersonal'];
            $personal->Tipo_Documento = $valor['Tipo_Documento'];
            $personal->Documento = $valor['Documento'];
            $personal->Nombre = $valor['Nombre'];
            $personal->Apellido = $valor['Apellido'];
            $personal->Telefono = $valor['Telefono'];
            $personal->Direccion= $valor['Direccion'];
            $personal->Correo = $valor['Correo'];
            $personal->Cargo = $valor['Cargo'];
            $personal->Rh = $valor['Rh'];
            $personal->Estado = $valor['Estado'];
            array_push($arraypersonal, $personal);
        }
        $tmp->Disconnect();
        return $arraypersonal;
    }

    public static function getAll()
    {
        return personal::buscar("SELECT * FROM personal");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO aerolinea.personal VALUES (NULL, ?,?,?,?,?,?,?,?,?,?)", array(

                $this->Tipo_Documento,
                $this->Documento,
                $this->Nombre,
                $this->Apellido,
                $this->Telefono,
                $this->Direccion,
                $this->Correo,
                $this->Cargo,
                $this->Rh,
                $this->Estado,

            )

        );

        $this->Disconnect();
    }

    public function editar()
    {
        $this->updateRow("UPDATE aerolinea.personal SET Tipo_Documento = ?, Documento = ?, Nombre = ?, Apellido = ?, Telefono = ?, Direccion = ?, Correo = ?, Cargo = ?, Rh = ?, Estado = ? WHERE idPersonal = ?", array(
            $this->Tipo_Documento,
            $this->Documento,
            $this->Nombre,
            $this->Apellido,
            $this->Telefono,
            $this->Direccion,
            $this->Correo,
            $this->Cargo,
            $this->Rh,
            $this->Estado,
            $this->idPersonal,
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
    public function getidPersonal()
    {
        return $this->idPersonal;
    }

    /**
     * @param string $idPersonal
     */
    public function setidPersonal($idPersonal)
    {
        $this->idPersonal = $idPersonal;
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
    public function getCargo()
    {
        return $this->Cargo;
    }

    /**
     * @param string $Cargo
     */
    public function setCargo($Cargo)
    {
        $this->Cargo = $Cargo;
    }

    /**
     * @return string
     */
    public function getRh()
    {
        return $this->Rh;
    }

    /**
     * @param string $Rh
     */
    public function setRh($Rh)
    {
        $this->Rh = $Rh;
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
