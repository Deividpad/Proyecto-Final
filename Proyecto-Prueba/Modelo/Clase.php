<?php

/**
 * Created by PhpStorm.
 * User: CAPACITACION-PC
 * Date: 16/6/2017
 * Time: 14:49
 */
require_once('db_abstract_class.php');

class Persona extends db_abstract_class
{
    private $idPersona;
    private $Tipo_Documento;
    private $Documento;
    private $Nombres;
    private $Apellidos;
    private $Telefono;
    private $Direccion;
    private $Correo;
    private $Foto;
    private $NRP;
    private $Fecha_Registro;
    private $Profesion;
    private $Usuario;
    private $Contrasena;
    private $Tipo_Usuario;
    private $Estado;

    /**
     * Persona constructor.
     * @param $idPersona
     * @param $Tipo_Documento
     * @param $Documento
     * @param $Nombres
     * @param $Apellidos
     * @param $Telefono
     * @param $Direccion
     * @param $Correo
     * @param $Foto
     * @param $NRP
     * @param $Fecha_Registro
     * @param $Profesion
     * @param $Usuario
     * @param $Contrasena
     * @param $Tipo_Usuario
     * @param $Estado
     */

    /**
     * Persona constructor.
     * @param $idPersona
     * @param $Tipo_Documento
     * @param $Documento
     * @param $Nombres
     * @param $Apellidos
     * @param $Telefono
     * @param $Direccion
     * @param $Correo
     * @param $Foto
     * @param $NRP
     * @param $Fecha_Registro
     * @param $Profesion
     * @param $Usuario
     * @param $Contrasena
     * @param $Tipo_Usuario
     * @param $Estado
     */

    public function __construct($persona_data=array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        if(count($persona_data)>1){ //
            foreach ($persona_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idPersona = "";
            $this->Tipo_Documento = "";
            $this->Documento = "";
            $this->Nombres = "";
            $this->Apellidos = "";
            $this->Telefono = "";
            $this->Direccion = "";
            $this->Correo = "";
            $this->Foto = "";
            $this->NRP = "";
            $this->Fecha_Registro = "";
            $this->Profesion = "";
            $this->Usuario = "";
            $this->Contrasena = "";
            $this->Tipo_Usuario = "";
            $this->Estado = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return mixed
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * @param mixed $idPersona
     */
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    /**
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->Tipo_Documento;
    }

    /**
     * @param mixed $Tipo_Documento
     */
    public function setTipoDocumento($Tipo_Documento)
    {
        $this->Tipo_Documento = $Tipo_Documento;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->Documento;
    }

    /**
     * @param mixed $Documento
     */
    public function setDocumento($Documento)
    {
        $this->Documento = $Documento;
    }

    /**
     * @return mixed
     */
    public function getNombres()
    {
        return $this->Nombres;
    }

    /**
     * @param mixed $Nombres
     */
    public function setNombres($Nombres)
    {
        $this->Nombres = $Nombres;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->Apellidos;
    }

    /**
     * @param mixed $Apellidos
     */
    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $Apellidos;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @param mixed $Correo
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->Foto;
    }

    /**
     * @param mixed $Foto
     */
    public function setFoto($Foto)
    {
        $this->Foto = $Foto;
    }

    /**
     * @return mixed
     */
    public function getNRP()
    {
        return $this->NRP;
    }

    /**
     * @param mixed $NRP
     */
    public function setNRP($NRP)
    {
        $this->NRP = $NRP;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->Fecha_Registro;
    }

    /**
     * @param mixed $Fecha_Registro
     */
    public function setFechaRegistro($Fecha_Registro)
    {
        $this->Fecha_Registro = $Fecha_Registro;
    }

    /**
     * @return mixed
     */
    public function getProfesion()
    {
        return $this->Profesion;
    }

    /**
     * @param mixed $Profesion
     */
    public function setProfesion($Profesion)
    {
        $this->Profesion = $Profesion;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->Usuario;
    }

    /**
     * @param mixed $Usuario
     */
    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    /**
     * @return mixed
     */
    public function getContrasena()
    {
        return $this->Contrasena;
    }

    /**
     * @param mixed $Contrasena
     */
    public function setContrasena($Contrasena)
    {
        $this->Contrasena = $Contrasena;
    }

    /**
     * @return mixed
     */
    public function getTipoUsuario()
    {
        return $this->Tipo_Usuario;
    }

    /**
     * @param mixed $Tipo_Usuario
     */
    public function setTipoUsuario($Tipo_Usuario)
    {
        $this->Tipo_Usuario = $Tipo_Usuario;
    }

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

    protected static function buscarForId($id)
    {
        // TODO: Implement buscarForId() method.
    }

    protected static function buscar($query)
    {
        // TODO: Implement buscar() method.
    }

    protected static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    protected function insertar()
    {
        $this->insertRow("INSERT INTO persona VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Tipo_Documento,
                $this->Documento,
                $this->Nombres,
                $this->Apellidos,
                $this->Telefono,
                $this->Direccion,
                $this->Correo,
                $this->Foto,
                $this->NRP,
                $this->Fecha_Registro,
                $this->Profesion,
                $this->Usuario,
                $this->Contrasena,
                $this->Tipo_Usuario,
                $this->Estado,
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


}