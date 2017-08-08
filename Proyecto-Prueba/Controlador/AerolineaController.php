<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once (__DIR__.'/../Modelo/aerolinea.php');

if(!empty($_GET['action'])){
    AerolineaController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
    }

class AerolineaController
{
    static function main($action){
        if ($action == "crear"){
            AerolineaController::crear();
        }else if ($action == "editar"){
            AerolineaController::editar();
        }else if ($action == "buscarID"){
            AerolineaController::buscarID();
        }else if ($action == "gestionarAerolinea"){
            AerolineaController::gestionarAerolinea();
        }else if ($action == "InactivarAerolinea"){
            AerolineaController::InactivarAerolinea();
        }else if ($action == "ActivarAerolinea"){
            AerolineaController::ActivarAerolinea();
        }
    }

    static public function crear ()
    {
        
        try {
            $arrayAerolinea = array();
            $arrayAerolinea['Razon_Social'] = $_POST['Razon_Social'];
            $arrayAerolinea['Nit'] = $_POST['Nit'];
            $arrayAerolinea['Direccion'] = $_POST['Direccion'];
            $arrayAerolinea['Correo'] = $_POST['Correo'];
            $arrayAerolinea['Telefono'] = $_POST['Telefono'];
            $arrayAerolinea['Estado'] = $_POST['Estado'];
            $Aerolinea = new aerolinea ($arrayAerolinea);
            $Aerolinea->insertar();
            header("Location: ../Vista/crearAerolinea.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../Vista/crearAerolinea.php?respuesta=error");
        }
    }


    static public function editar (){
        try {
            $arrayAerolinea = array();
            $arrayAerolinea['Razon_Social'] = $_POST['Razon_Social'];
            $arrayAerolinea['Nit'] = $_POST['Nit'];
            $arrayAerolinea['Direccion'] = $_POST['Direccion'];
            $arrayAerolinea['Correo'] = $_POST['Correo'];
            $arrayAerolinea['Telefono'] = $_POST['Telefono'];
            $arrayAerolinea['Estado'] = $_POST['Estado'];
            $arrayAerolinea['idAerolinea'] = $_POST['idAerolinea'];
            $aerolinea = new aerolinea($arrayAerolinea);
            //var_dump($aerolinea);
            $aerolinea->editar();

            header("Location: ../Vista/gestionarAerolineas.php");
        } catch (Exception $e) {
           //header("Location: ../Vista/gestionarAerolineas.php");
            echo "Erorr";
        }
    }

        static public function buscarID ($id){
            try {
                return aerolinea::buscarForId($id);
            } catch (Exception $e) {
                //header("Location: ../gestionarEspecialidades.php?respuesta=error");
            }
        }


    static public function InactivarAerolinea()
    {
                echo "Llamo a Inactivoar";
        try {
            $ObjAerolinea = Aerolinea::buscarForId($_GET['idAero']);
            $ObjAerolinea->setEstado("Inactiva");
            $ObjAerolinea->editar($_GET['idAero']);
            //var_dump($ObjAerolinea);
            header("Location: ../Vista/gestionarAerolineas.php");
        } catch (Exception $e) {
            header("Location: ../Vista/gestionarAerolineas.php");
        }
    }


    static public function ActivarAerolinea()
    {
        echo "Llamo a Activar";
            try {
                $ObjAerolinea = Aerolinea::buscarForId($_GET['idAero']);
                $ObjAerolinea->setEstado("Activa");
                $ObjAerolinea->editar($_GET['idAero']);
                //var_dump($ObjAerolinea);
                header("Location: ../Vista/gestionarAerolineas.php");
            } catch (Exception $e) {
                header("Location: ../Vista/gestionarAerolineas.php");
            }
    }


        static public function gestionarAerolinea (){
            $arrayAerolinea = aerolinea::getAll();
            //var_dump($arrayAerolinea);
            $htmlTable ="";

            foreach ($arrayAerolinea as $ObjAerolinea){
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>".$ObjAerolinea->getIdAerolinea()."</td>";
                $htmlTable .= "<td>".$ObjAerolinea->getRazonSocial()."</td>";
                $htmlTable .= "<td>".$ObjAerolinea->getNit()."</td>";
                $htmlTable .= "<td>".$ObjAerolinea->getDireccion()."</td>";
                $htmlTable .= "<td>".$ObjAerolinea->getCorreo()."</td>";
                $htmlTable .= "<td>".$ObjAerolinea->getTelefono()."</td>";

                //$htmlTable .= "<td>";
                //$htmlTable .= "<a class='btn btn-primary'href='crearAerolinea.php'><i class='icon_plus_alt2'></i>Agregar Avion</a>";
                //$htmlTable .= "</td>";
                $icons = "";
                if ($ObjAerolinea->getEstado() == "Inactiva") {
                    $icons .= "<a data-toggle='tooltip' title='Activar Aerolinea' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' 
                    href='../Controlador/AerolineaController.php?action=ActivarAerolinea&idAero=" . $ObjAerolinea->getIdAerolinea() . "'><i class='fa fa-times'></i></a>";
                    $icons .= "<a href='../Vista/editarAerolinea.php?idAerolinea=".$ObjAerolinea->getIdAerolinea()."' type='button' data-toggle='tooltip' title='Editar' class='btn docs-tooltip btn-primary btn-xs'><i class='fa fa-edit'></i></a>";

                } else if ($ObjAerolinea->getEstado() == "Activa") {

                    $icons .= "<a data-toggle='tooltip' title='Inactivar Aerolinea' data-placement='top' class='btn btn-social-icon btn-success newTooltip' 
                    href='../Controlador/AerolineaController.php?action=InactivarAerolinea&idAero=" . $ObjAerolinea->getIdAerolinea() ."'><i class='fa fa-check'></i></a>";
                    $icons .= "<a href='../Vista/editarAerolinea.php?idAerolinea=".$ObjAerolinea->getIdAerolinea()."' type='button' data-toggle='tooltip' title='Editar' class='btn docs-tooltip btn-primary btn-xs'><i class='fa fa-edit'></i></a>";


                }else if ($ObjAerolinea->getEstado() == "Realizado") {
                    //$icons = "<a class='btn btn-danger' disabled href='../Controlador/VueloController.php?action=RealizadoVuelo&IdVuelo=" . $ObjAerolinea->getIdAerolinea() . "' title='Bootstrap 3 themes generator'>Vuelo Realizado</a>";
                }



                $htmlTable .= "<td>" . $icons . "</td>";
                $htmlTable .= "</tr>";

            }
            return $htmlTable;
       }

        /*static public function SelectAerolinea ($isRequired=true, $id="idAerolinea", $nombres="idAerolinea", $class=""){
            $arrayAerolinea = aerolinea::getAll();
            $htmlSelect = "";
            $htmlSelect .= "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombres."' class='".$class."'>";
            foreach ($arrayAerolinea as $ObjAerolinea){
                $htmlSelect .= "<option value='".$ObjAerolinea->getIdAerolinea()."' id='".$ObjAerolinea->getIdAerolinea()."'>".$ObjAerolinea->getRazonSocial()."</option>";                                                              ;
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }*/


    static public function SelectAerolinea ($isRequired=true, $id="Avion_idAvion", $nombres="Avion_idAvion", $class="")
    {
        $arrayAvion = aerolinea::getAll(); /*  */
        $avionesactivos = array();
        $htmlSelect = "";
        $htmlSelect .= "<select " . (($isRequired) ? "required" : "") . " id= '" . $id . "' name='" . $nombres . "' class='" . $class . "'>";

        foreach ($arrayAvion as $Acitvo) {
            if ($Acitvo->getEstado() == "Activa") {
                $avion = new aerolinea();
                $avion = $Acitvo->getIdAerolinea();
                array_push($avionesactivos, $avion);
                //var_dump($avionesactivos);
            }
        }
        if (count($avionesactivos) >= 1) {
            foreach ($avionesactivos as $obj) {
                $ObjAvion = aerolinea::buscarForId($obj);
                $idaero = $ObjAvion->getIdAerolinea();
                $idaeronom = aerolinea::buscarForId($idaero);
                $htmlSelect .= "<option value='" . $ObjAvion->getIdAerolinea() . "' id='" . $ObjAvion->getIdAerolinea() . "'>" .$idaeronom->getRazonSocial(); "</option>";
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        } else {
            $htmlSelect .= "<option>No hay Aerolineas Disponibles</option>";
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }
    }



























}