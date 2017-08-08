<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once (__DIR__.'/../Modelo/Avion.php');
require_once (__DIR__.'/../Modelo/Aerolinea.php');

if(!empty($_GET['action'])){
    AvionController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
    }

class AvionController
{
    static function main($action){
        if ($action == "crear"){
            AvionController::crear();
        }else if ($action == "editar"){
            AvionController::editar();
        }else if ($action == "buscarID"){
            AvionController::buscarID();
        }else if ($action == "gestionarAvion"){
                AvionController::gestionarAvion();
        }else if ($action == "InactivarAvion"){
            AvionController::InactivarAvion();
        }else if ($action == "ActivarAvion"){
            AvionController::ActivarAvion();
        }else if ($action == "DestinarAvion"){
            AvionController::DestinarAvion();
        }
    }

    static public function editar (){
        try {
            $arrayAvion = array();
            $arrayAvion['Nombre'] = $_POST['Nombre'];
            $arrayAvion['Modelo'] = $_POST['Modelo'];
            $arrayAvion['Tiempo_Vuelo'] = $_POST['Tiempo_Vuelo'];
            $arrayAvion['Capacidad_Silla'] = $_POST['Capacidad_Silla'];
            $arrayAvion['Asiento_Negocios_Fin'] = $_POST['Negofin'];
            $arrayAvion['Aerolinea_idAerolinea'] = $_POST['idAerolinea'];
            $arrayAvion['Estado'] = $_POST['Estado'];
            $arrayAvion['idAvion'] = $_POST['idAvion'];
            $avion = new Avion ($arrayAvion);
            //var_dump($arrayRuta);
            $avion->editar();
            echo "Edito";
            header("Location: ../Vista/gestionarAviones.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarAviones.php?respuesta=error");
            echo "Erorr";
        }
    }


    static public function crear (){        

        if ($_POST['idAerolinea'] == "No hay Aerolineas Disponibles"){
            header("Location: ../Vista/crearAvion.php?respuesta=error");
        }else{
            try {
                $arrayAvion = array();
                $arrayAvion['Nombre'] = $_POST['Nombre'];
                $arrayAvion['Modelo'] = $_POST['Modelo'];
                $arrayAvion['Tiempo_Vuelo'] = $_POST['Tiempo_Vuelo'];
                $arrayAvion['Capacidad_Silla'] = $_POST['Capacidad_Silla'];
                $arrayAvion['Asiento_Negocios_Fin'] = $_POST['Negofin'];
                $arrayAvion['Aerolinea_idAerolinea'] = $_POST['idAerolinea'];
                $arrayAvion['Estado'] = $_POST['Estado'];

                $Avion = new Avion($arrayAvion);
                //var_dump($arrayAvion);
                $Avion->insertar();
                header("Location: ../Vista/crearAvion.php?respuesta=correcto");
            } catch (Exception $e) {
                header("Location: ../Vista/crearAvion.php?respuesta=error");
            }
        }

        
    }

        static public function buscarID ($id){
            try {
                return avion::buscarForId($id);
            } catch (Exception $e) {
                //header("Location: ../gestionarEspecialidades.php?respuesta=error");
            }
        }

    static public function InactivarAvion (){
        try {

            $ObjAvion = Avion::buscarForId($_GET['IdAvion']);
            $ObjAvion->setEstado("Inactivo");
            $ObjAvion->editar($_GET['IdAvion']);
            //var_dump($ObjAvion);
            header("Location: ../Vista/gestionarAviones.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../Vista/gestionarAviones.php?respuesta=error");
        }
    }

    static public function ActivarAvion (){
        try {

            $ObjAvion = Avion::buscarForId($_GET['IdAvion']);
            $ObjAvion->setEstado("Activo");
            $ObjAvion->editar($_GET['IdAvion']);
            //var_dump($ObjAvion);
            header("Location: ../Vista/gestionarAviones.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarEspecialidades.php?respuesta=error");
            echo "Error";
        }
    }

    static public function VolverActivar ($id){
        try {

            $ObjAvion = Avion::buscarForId($id);
            $ObjAvion->setEstado("Activo");
            $ObjAvion->editar($id);
            //var_dump($ObjAvion);
            //header("Location: ../Vista/gestionarAviones.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarEspecialidades.php?respuesta=error");
            echo "Error en Volver activar en Aviion Controller";
        }
    }

    static public function DestinarAvion ($id){
            echo "Entro al medito destinar";
        try {

            $ObjAvion = Avion::buscarForId($id);
            $ObjAvion->setEstado("Destinado");
            $ObjAvion->editar($id);
            //var_dump($ObjAvion);
            //header("Location: ../Vista/gestionarAviones.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarEspecialidades.php?respuesta=error");
            echo "Error";
        }
    }

        static public function gestionarAvion (){
            $arrayAvion = avion::getAll();
            //var_dump($arrayAvion);
            $htmlTable ="";

            if (count($arrayAvion) >=1) {
                foreach ($arrayAvion as $ObjAvion) {
                    $htmlTable .= "<tr>";
                    $htmlTable .= "<td>" . $ObjAvion->getidAvion() . "</td>";
                    $htmlTable .= "<td>" . $ObjAvion->getNombre() . "</td>";
                    $htmlTable .= "<td>" . $ObjAvion->getModelo() . "</td>";
                    $htmlTable .= "<td>" . $ObjAvion->getTiempoVuelo() . "</td>";
                    $htmlTable .= "<td>" . $ObjAvion->getCapacidadSilla() . "</td>";
                    $id = $ObjAvion->getAerolineaIdAerolinea();
                    $aero = Aerolinea::buscarForId($id);
                    $RazonSocial = $aero->getRazonSocial();
                    $htmlTable .= "<td>$RazonSocial</td>";
                    $htmlTable .= "<td>" . $ObjAvion->getEstado() . "</td>";

                    $icons = "";
                    if ($ObjAvion->getEstado() == "Inactivo") {
                        $icons .= "<a data-toggle='tooltip' title='Activar Avion' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' 
                    href='../Controlador/AvionController.php?action=ActivarAvion&IdAvion=" . $ObjAvion->getidAvion() . "'><i class='fa fa-times'></i></a>";
                        $icons .= "<a href='../Vista/editarAvion.php?idAvion=".$ObjAvion->getidAvion()."' type='button' data-toggle='tooltip' title='Editar' class='btn docs-tooltip btn-primary btn-xs'><i class='fa fa-edit'></i></a>";
                    } else if ($ObjAvion->getEstado() == "Activo") {
                        $icons .= "<a data-toggle='tooltip' title='Inactivar Avion' data-placement='top' class='btn btn-social-icon btn-success newTooltip' 
                    href='../Controlador/AvionController.php?action=InactivarAvion&IdAvion=" . $ObjAvion->getidAvion() . "'><i class='fa fa-check'></i></a>";
                        $icons .= "<a href='../Vista/editarAvion.php?idAvion=".$ObjAvion->getidAvion()."' type='button' data-toggle='tooltip' title='Editar' class='btn docs-tooltip btn-primary btn-xs'><i class='fa fa-edit'></i></a>";
                    } else {
                        $icons = "<div class='btn-group'>
                                                  <a class='btn btn-warning' href='' disabled title='Bootstrap 3 themes generator'>Este Avion ya tiene un Vuelo</a>
                                                  
                                                  
                                           </div>";
                    }

                    $htmlTable .= "<td>" . $icons . "</td>";
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


    static public function SelectAvion ($isRequired=true, $id="Avion_idAvion", $nombres="Avion_idAvion", $class="")
    {
        $arrayAvion = avion::getAll(); /*  */
        $avionesactivos = array();
        $htmlSelect = "";
        $htmlSelect .= "<select " . (($isRequired) ? "required" : "") . " id= '" . $id . "' name='" . $nombres . "' class='" . $class . "'>";

        foreach ($arrayAvion as $Acitvo) {
            if ($Acitvo->getEstado() == "Activo") {
                $avion = new avion();
                $avion = $Acitvo->getIdAvion();
                array_push($avionesactivos, $avion);
                //var_dump($avionesactivos);
            }
        }
        if (count($avionesactivos) >= 1) {
            foreach ($avionesactivos as $obj) {
                $ObjAvion = avion::buscarForId($obj);
                $idaero = $ObjAvion->getAerolineaIdAerolinea();
                $idaeronom = aerolinea::buscarForId($idaero);
                $htmlSelect .= "<option value='" . $ObjAvion->getIdAvion() . "' id='" . $ObjAvion->getIdAvion() . "'>" . $ObjAvion->getNombre().'-'. $idaeronom->getRazonSocial(); "</option>";
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        } else {
            $htmlSelect .= "<option>No hay Aviones Disponibles</option>";
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }
    }


    }