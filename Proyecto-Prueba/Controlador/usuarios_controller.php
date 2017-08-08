<?php
session_start();
require_once (__DIR__.'/../Modelo/db_abstract_class.php');
require_once (__DIR__.'/../Modelo/usuarios_class.php');

if(!empty($_GET['action'])){
	usuarios_controller::main($_GET['action']);
}

class usuarios_controller {

    /**
     * usuarios_controller constructor.
     */
    public function __construct()
    {
    }

    static function main($action){
		if ($action == "crear"){
			usuarios_controller::crear();
		}else if ($action == "editar"){
			usuarios_controller::editar();
		}else if ($action == "buscarID"){
			usuarios_controller::buscarID(1);
		}else if($action == "Login"){
			usuarios_controller::Login();
		}else if($action == "CerrarSession"){
			usuarios_controller::CerrarSession();
		}
	}
	
	static public function crear (){
		try {
			$arrayUser = array();
			$arrayUser['User'] = $_POST['User'];
			$arrayUser['Password'] = $_POST['Password'];
			$usuario = new usuarios ($arrayUser);
			$usuario->insertar();
			header("Location: ../insertar.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../insertar.php?respuesta=error");
		}
	}
	
	static public function editar (){
		try {
			$arrayUser = array();
			$arrayUser['User'] = $_POST['User'];
			$arrayUser['Password'] = $_POST['Password'];
			$arrayUser['idUsuarios'] = $_POST['idUsuarios'];
			var_dump($arrayUser);
			$usuario = new usuarios ($arrayUser);
			$usuario->editar();
			header("Location: ../editar.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../editar.php?respuesta=error");
		}
	}
	
	static public function buscarID ($id){
		try { 
			return usuarios::buscarForId($id);
		} catch (Exception $e) {
			header("Location: ../buscar.php?respuesta=error");
		}
	}
	
	public function buscarAll (){
		try {
			return usuarios::getAll();
		} catch (Exception $e) {
			header("Location: ../buscar.php?respuesta=error");
		}
	}

	public function buscar ($campo, $parametro){
		try {
			return usuarios::getAll();
		} catch (Exception $e) {
			header("Location: ../buscar.php?respuesta=error");
		}
	}

	public function Login (){
		try {
			$User = $_POST['User'];
			$Password = $_POST['Password'];
			if(!empty($User) && !empty($Password)){
				$respuesta = usuarios::Login($User, $Password);
				if (is_array($respuesta)) {
					$_SESSION['idUsuario'] = $respuesta['idUsuario'];
					echo TRUE;
				}else if($respuesta == "Password Incorrecto"){
					echo "<div class='ui-state-error ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>";
						echo "<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>";
						echo "<strong>¡Error!</strong> La contraseña no coincide con el usuario</p>";
					echo "</div>";
				}else if($respuesta == "No existe el usuario"){
					echo "<div class='ui-state-error ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>";
						echo "<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>";
						echo "<strong>¡Error!</strong> No existe un usuario con estos datos</p>";
					echo "</div>";
				}
			}else{
				echo "<div class='ui-state-error ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>";
					echo "<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>";
					echo "<strong>¡Error!</strong> Ingrese los datos</p>";
				echo "</div>";
			}
		} catch (Exception $e) {
			header("Location: ../login.php?respuesta=error");
		}
	}

	public function CerrarSession (){
		session_destroy();
		header("Location: ../Vista/login.php");
	}



	
}
?>