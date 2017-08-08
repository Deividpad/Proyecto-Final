<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once (__DIR__.'/../Modelo/Ciudades.php');
require_once (__DIR__.'/../Modelo/Departamentos.php');

if(!empty($_GET['action'])){
    CiudadesController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
}
class CiudadesController
{

    static function main($action){
        if ($action == "crear"){
            CiudadesController::crear();
        }else if ($action == "editar"){
            CiudadesController::editar();
        }else if ($action == "buscarID"){
            CiudadesController::buscarID();
        }else if ($action == "gestionarCiudades"){
            CiudadesController::gestionarCiudades();

        }
    }


    static public function crear()
    {
            if($_POST['idDepartamentos'] != "No hay Departamentos Disponibles"){
                try {
                    $arrayCiudades = array();

                    $arrayCiudades['Ciudad'] = $_POST['Ciudad'];
                    $arrayCiudades['Departamentos_idDepartamentos'] = $_POST['idDepartamentos'];
                    $Ciudades = new Ciudades ($arrayCiudades);
                    //echo "La ciudad".$_POST['Ciudad'];;
                    //echo "El id depar".$_POST['idDepartamentos'];
                    //var_dump($Ciudades);
                    $Ciudades->insertar();

                    header("Location: ../Vista/gestionarCiudades.php?respuesta=correcto");
                } catch (Exception $e) {
                    header("Location: ../Vista/gestionarCiudades.php?respuesta=error");
                }
            }else {
                header("Location: ../Vista/gestionarCiudades.php?respuesta=error");
            }
    }

    static public function editar (){
        try {
            $arrayCiudad = array();
            $arrayCiudad['Ciudad'] = $_POST['Ciudad'];
            $arrayCiudad['Departamentos_idDepartamentos'] = $_POST['idDepartamentos'];
            $arrayCiudad['idCiudades'] = $_POST['idCiudad'];
            $ciudad = new Ciudades($arrayCiudad);
            var_dump($arrayCiudad);
            $ciudad->editar();
            echo "Edito";
            header("Location: ../Vista/gestionarCiudades.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarCiudades.php?respuesta=error");
            echo "Erorr";
        }
    }

    static public function buscarID ($id){
        try {
            return Vacuna::buscarForId($id);
        } catch (Exception $e) {
            //header("Location: ../gestionarEspecialidades.php?respuesta=error");
        }
    }


    static public function gestionarCiudades(){
        $arrayCiudades = ciudades::getAll();

        $htmlTable ="";

        if (count($arrayCiudades) >=1) {
            foreach ($arrayCiudades as $ObjCiudades) {
                $htmlTable .= "<tr style='color: black'>";
                $htmlTable .= "<td>" . $ObjCiudades->getIdCiudades() . "</td>";
                //$htmlTable .= "<td>" . $ObjCiudades->getDepartamento() . "</td>";
                $idep = $ObjCiudades->getDepartamentosIdDepartamentos();
                $dep = Departamentos::buscarForId($idep);
                $htmlTable .= "<td>" . $dep->getDepartamentos() . "</td>";
                $htmlTable .= "<td>" . $ObjCiudades->getCiudad() . "</td>";
                //$htmlTable .= "<td>" . $ObjCiudades->getDepartamentosIdDepartamentos() . "</td>";

                $icons = "";
                $icons .= "<a href='../Vista/editarCiudades.php?idCiudades=".$ObjCiudades->getIdCiudades()."' type='button' data-toggle='tooltip' title='Actualizar' <i class=\"icon_\"><img src=\"NiceAdmin/img/i.from/edi.png\"></i></i></a>";

                $htmlTable .= "<td>" . $icons . "</td>";
                $htmlTable .= "</tr>";

            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay Ciudades Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }

    static public function SelectCiudades ($isRequired=true, $id="idCiudades", $nombres="idCiudades", $class=""){
        $arrayCiudades = ciudades::getAll(); /*  */
        $htmlSelect = "";
        $htmlSelect .= "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombres."' class='".$class."'>";

        if (count($arrayCiudades)>=1) {
            foreach ($arrayCiudades as $ObjCiudades) {
                $htmlSelect .= "<option value='" . $ObjCiudades->getIdCiudades() . "' id='" . $ObjCiudades->getIdCiudades() . "'>" . $ObjCiudades->getCiudad() . "</option>";
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }else {
                $htmlSelect .= "<option>No hay Ciudades Disponibles</option>";
                $htmlSelect .= "</select>";
                return $htmlSelect;
            }
    }





}