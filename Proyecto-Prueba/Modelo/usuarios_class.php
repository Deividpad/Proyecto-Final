<?php
require_once('db_abstract_class.php');

class usuarios extends db_abstract_class{

	private $idUsuarios;
    private $User;
    private $Password;


    /**
     * Gets the value of idUsuarios.
     *
     * @return mixed
     */
    public function getIdUsuarios()
    {
        return $this->idUsuarios;
    }

    /**
     * Sets the value of idUsuarios.
     *
     * @param mixed $idUsuarios the id usuarios
     *
     * @return self
     */
    private function _setIdUsuarios($idUsuarios)
    {
        $this->idUsuarios = $idUsuarios;

        return $this;
    }


    /**
     * Gets the value of User.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Sets the value of User.
     *
     * @param mixed $User the user
     *
     * @return self
     */
    private function _setUser($User)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * Gets the value of Password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Sets the value of Password.
     *
     * @param mixed $Password the password
     *
     * @return self
     */
    private function _setPassword($Password)
    {
        $this->Password = $Password;

        return $this;
    }


    function __destruct() {
        $this->Disconnect();
    }

	public function __construct($user_data=array()){
        parent::__construct();
		if(count($user_data)>1){
			foreach ($user_data as $campo=>$valor){
                $this->$campo = $valor;
			}
		}else {
            $this->User = "";
            $this->Password = "";
		}
    }

    public function insertar(){
        $this->insertRow("INSERT INTO usuarios
            VALUES ('NULL', ?, ?)", array(
                $this->User,
                $this->Password,
            )
        );
		$this->Disconnect();
    }

    public function editar(){
		$arrUser = (array) $this;
		$this->updateRow("UPDATE usuarios SET  User = ?, Password = ? WHERE idUsuarios = ?", array(
            $this->User,
            $this->Password,
			$this->idUsuarios,
		));
		$this->Disconnect();
    }

    public function eliminar($id){

    }

    public static function buscarForId($id){
		if ($id > 0){
			$usr = new usuarios();
			$getrow = $usr->getRow("SELECT * FROM usuarios WHERE idUsuarios =?", array($id));
			$usr->idUsuarios = $getrow['idUsuarios'];
            $usr->User = $getrow['User'];
            $usr->Password = $getrow['Password'];
			$usr->Disconnect();
			return $usr;
		}else{
			return NULL;
		}
		$this->Disconnect();
    }

    public static function getAll(){
		return usuarios::buscar("SELECT * FROM usuarios");
    }

	public static function buscar($query){
        $arrUsuarios = array();
        $tmp = new usuarios();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $usr = new usuarios();
            $usr->idUsuarios = $getrow['idUsuarios'];
            $usr->User = $getrow['User'];
            $usr->Password = $getrow['Password'];
            array_push($arrUsuarios, $usr);
        }
        $tmp->Disconnect();
        return $arrUsuarios;
    }

    public static function Login($User, $Password){
        $arrUsuarios = array();
        $tmp = new usuarios();
        $getTempUser = $tmp->getRows("SELECT * FROM usuario WHERE Documento = '$User'");
        if(count($getTempUser) >= 1){
            $getrows = $tmp->getRows("SELECT * FROM usuario WHERE Documento = '$User' AND Contrasena = '$Password'");
            if(count($getrows) >= 1){
                foreach ($getrows as $valor) {
                    return $valor;
                }
            }else{
                return "Password Incorrecto";
            }
        }else{
            return "No existe el usuario";
        }

        $tmp->Disconnect();
        return $arrUsuarios;
    }

}

?>