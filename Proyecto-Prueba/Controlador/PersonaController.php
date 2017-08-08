<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

require_once (__DIR__.'/../Modelo/personal.php');
require_once (__DIR__.'/../Modelo/personal_has_vuelo.php');

if(!empty($_GET['action'])){
    PersonaController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
    }

class PersonaController
{

    static function main($action)
    {

        if ($action == "crear") {
            PersonaController::crear();
        } else if ($action == "editar") {
            PersonaController::editar();
        } else if ($action == "buscarID") {
            PersonaController::buscarID();
        } else if ($action == "gestionarPersonal") {
            PersonaController::gestionarPersonal();
        }else if ($action == "personahasvuelo") {
            PersonaController::personahasvuelo();

        }
    }

    static public function crear()
    {
            try {

                $arrayPersonal = array();
                $arrayPersonal['Tipo_Documento'] = $_POST['Tipo_Documento'];
                $arrayPersonal['Documento'] = $_POST['Documento'];
                $arrayPersonal['Nombre'] = $_POST['Nombre'];
                $arrayPersonal['Apellido'] = $_POST['Apellido'];
                $arrayPersonal['Telefono'] = $_POST['Telefono'];
                $arrayPersonal['Direccion'] = $_POST['Direccion'];
                $arrayPersonal['Correo'] = $_POST['Correo'];
                $arrayPersonal['Cargo'] = $_POST['Cargo'];
                $arrayPersonal['Rh'] = $_POST['Rh'];
                $arrayPersonal['Estado'] = $_POST['Estado'];
                $personal = new personal($arrayPersonal);
                // var_dump($personal);
                $personal->insertar();
                header("Location: ../Vista/crearPersona.php?respuesta=correcto");
            } catch (Exception $e) {
                header("Location: ../Vista/crearPersona.php?respuesta=error");

            }


    }

    static public function editar()
    {

        try {
            $arrayPersonal = array();
            $arrayPersonal['Tipo_Documento'] = $_POST['Tipo_Documento'];
            $arrayPersonal['Documento'] = $_POST['Documento'];
            $arrayPersonal['Nombre'] = $_POST['Nombre'];
            $arrayPersonal['Apellido'] = $_POST['Apellido'];
            $arrayPersonal['Telefono'] = $_POST['Telefono'];
            $arrayPersonal['Direccion'] = $_POST['Direccion'];
            $arrayPersonal['Correo'] = $_POST['Correo'];
            $arrayPersonal['Cargo'] = $_POST['Cargo'];
            $arrayPersonal['Rh'] = $_POST['Rh'];
            $arrayPersonal['idPersonal'] = $_POST['idPersonal'];
            $personal = new personal($arrayPersonal);
            $personal->editar();
            header("Location: ../Vista/gestionarPersonal.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/editarPersona.php?respuesta=error");
        }
    }


    static public function personahasvuelo(){
        echo "La variable desde ".$_SESSION["idpersonal"];
        $havepersonal = personal_has_vuelo::PersonalnoRepeat($_GET['IdVuelo'], $_SESSION["idpersonal"]);



        if ($havepersonal){
            $idv = $_GET['IdVuelo'];
            $idp = $_SESSION["idpersonal"];
            $array = array();
            $array ['Personal_idPersonal'] = $idp;
            $array ['Vuelo_idVuelo'] = $idv;
            $phv = new personal_has_vuelo($array);
            $phv->insertar();
            header("Location: ../Vista/gestionarPersonal.php?respuesta=correcto");
        }else{
            header("Location: ../Vista/gestionarPersonal.php?respuesta=error");
        }




    }

    static public function buscarID($id)
    {
        try {
            return personal::buscarForId($id);
        } catch (Exception $e) {
           header("Location: ../gestionarPersonal.php?respuesta=error");
        }
    }


    static public function gestionarPersonal()
    {
        $arrayPersonal = personal::getAll();

        $htmlTable = "";

        if (count($arrayPersonal) >=1) {
            foreach ($arrayPersonal as $Objpersonal) {
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>" . $Objpersonal->getNombre() . "</td>";
                $htmlTable .= "<td>" . $Objpersonal->getApellido() . "</td>";
                $htmlTable .= "<td>" . $Objpersonal->getCargo() . "</td>";
                $icons ="";
                $icons .= "<a class='btn btn-success btn-sm' href='asignarVuelos.php?idPersona=".$Objpersonal->getidPersonal()."' title='Bootstrap 3 themes generator'>Asignar Vuelo</a>";
                $icons .= "<a href='../Vista/editarPersona.php?idPersonal=".$Objpersonal->getidPersonal()."' type='button' data-toggle='tooltip'  title='Actualizar' <i class=\"icon_\"><img src=\"NiceAdmin/img /i.from/edi.png\"></i></i></a>";
                $htmlTable .= " <td>$icons</td>";
                $htmlTable .= "</tr>";

            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay Aviones Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }


    static public function PersonalAsignado($idVuelo)
    {

        $havepersonal = personal_has_vuelo::VueloPersona($idVuelo);




        $htmlTable = "";

        if (count($havepersonal) >=1) {
            foreach ($havepersonal as $Objpersonal) {
                $idp = personal::buscarForId($Objpersonal);
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>" . $idp->getNombre() . "</td>";
                $htmlTable .= "<td>" . $idp->getApellido() . "</td>";
                $htmlTable .= "<td>" . $idp->getCargo() . "</td>";
                $htmlTable .= "</tr>";
            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay Personal </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }
}






