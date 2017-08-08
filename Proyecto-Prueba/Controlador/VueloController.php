<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once (__DIR__.'/../Modelo/Vuelo.php');
require_once (__DIR__.'/../Modelo/Avion.php');
require_once (__DIR__.'/../Modelo/Aerolinea.php');
require_once (__DIR__.'/../Modelo/Rutas.php');
require_once (__DIR__.'/../Modelo/Ciudades.php');
require_once (__DIR__.'/../Modelo/personal_has_vuelo.php');

if(!empty($_GET['action'])){
    VueloController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
}

class VueloController
{
    static function main($action)
    {
        if ($action == "crear") {
            VueloController::crear();
        } else if ($action == "editar") {
            VueloController::editar();
        } else if ($action == "buscarID") {
            VueloController::buscarID();
        } else if ($action == "gestionarVuelo") {
            VueloController::gestionarVuelo();
        } else if ($action == "InactivarVuelo") {
            VueloController::InactivarVuelo();
        } else if ($action == "ActivarVuelo") {
            VueloController::ActivarVuelo();
        } else if ($action == "RealizadoVuelo") {
            VueloController::RealizadoVuelo();
        }

    }

    static public function TiempoVuelo()
    {
        //Lamar al tiempo de vuelo en rutas
        $id = Rutas::buscarForId($_POST['Rutas_idRutas']);
        $ruta = $id->getDuracion();
        //Llamar al tiempo de vuelo en aviones
        $idAV = avion::buscarForId($_POST['Avion_idAvion']);
        $avion = $idAV->getTiempoVuelo();
        if ($avion>= $ruta){
            //echo "El avion se puede utilizar";
            return 1;
        }else{
            //echo "El tiempo de vuelo supera al avion escogido";
            return 0;
        }
    }

    static public function Fecha(){
        /*$arrayVuelo = vuelo::getAll();
        $Actual = date('Y-m-d');
        $t = strototime("$Actual");
        //echo "La  actual ".$Actual;
        $ingreso = strtotime($_POST['Fecha']);
        //echo "La que ingreso".$ingreso;
        if ($ingreso > $t ){
                echo "Es menor no entiende";
        }else{
            echo "Me sirve";
        }*/

        $fecha = $_POST['Fecha'];
        $fecha2 = explode(" ",$fecha);
        $fecha3 = $fecha2[0];
        $fecha4 = strtotime("$fecha3 +0 week");
        $fechaHoy = date('Y-m-d');
        $fechaHoy2 = strtotime("$fechaHoy");
        if($fecha4 >= $fechaHoy2){
            $entra = strtotime($_POST['Hora'])."<br>";
            $horaActual = gettimeofday(true);

            //$r= localtime(true);

            if ($entra < $horaActual){
                //echo " La hora no me sirve ";
            }else{
                //echo "Me sirve la hora";
            }

        }else{
            echo "Es menor no entiende";
        }

    }
    static public function crear()
    {


        if ($_POST['Avion_idAvion'] >= 1 && $_POST['Rutas_idRutas']>=1) {

                    try {
                        $arrayVuelo = array();
                        //$arrayVuelo['Fecha'] = $_POST['Fecha'];
                        $originalDate = $_POST['Fecha2'];
                        $newDate = date("Y-m-d", strtotime($originalDate));
                        $arrayVuelo['Fecha'] = $newDate;
                        //echo "La fecha".$_POST['Fecha2'];
                        $arrayVuelo['Hora'] = $_POST['Hora'];
                        $arrayVuelo['Tipo'] = $_POST['Tipo'];
                        $arrayVuelo['Avion_idAvion'] = $_POST['Avion_idAvion'];
                        $arrayVuelo['Rutas_idRutas'] = $_POST['Rutas_idRutas'];;
                        $arrayVuelo['Estado'] = $_POST['Estado'];
                        $Vuelo = new vuelo($arrayVuelo);
                        $Vuelo->insertar();
                        $id = $_POST['Avion_idAvion'];
                        $ObjAvion = avion::buscarForId($id);
                        $ObjAvion->setEstado("Destinado");
                        $ObjAvion->editar($id);
                        //var_dump($Vuelo);

                        header("Location: ../Vista/crearVuelo.php?respuesta=correcto");
                    } catch (Exception $e) {
                        echo "Error";
                        header("Location: ../Vista/crearVuelo.php?respuesta=error");
                    }
                }else{
                    header("Location: ../Vista/crearVuelo.php?respuesta=errortiempo");
                }
    }


    static public function InactivarVuelo()
    {
        try {

            $ObjVuelo = Vuelo::buscarForId($_GET['IdVuelo']);
            $ObjVuelo->setEstado("Inactivo");
            $ObjVuelo->editar($_GET['IdVuelo']);
            //var_dump($ObjAvion);
            header("Location: ../Vista/gestionarVuelos.php");
        } catch (Exception $e) {
            header("Location: ../Vista/gestionarVuelos.php?respuesta=error");
        }
    }

    static public function ActivarVuelo()
    {
        $havepersonal = personal_has_vuelo::isPersonal($_GET['IdVuelo']);
        if ($havepersonal ==5){
            echo "si tiene".$havepersonal;
            try {

                $ObjVuelo = Vuelo::buscarForId($_GET['IdVuelo']);
                $ObjVuelo->setEstado("Activo");
                $ObjVuelo->editar($_GET['IdVuelo']);
                var_dump($ObjVuelo);
                header("Location: ../Vista/gestionarVuelos.php");
            } catch (Exception $e) {
                header("Location: ../Vista/gestionarVuelos.php?respuesta=error");
                echo "Error del try";
            }

        }else{
            header("Location: ../Vista/gestionarVuelos.php?respuesta=error");
            echo "Por favor ingrese el personal de vuelo adecuado";
        }
    }

    static public function RealizadoVuelo()
    {
        try {

            $ObjVuelo = Vuelo::buscarForId($_GET['IdVuelo']);
            $id = $ObjVuelo->getAvionIdAvion();
            require("../Controlador/AvionController.php");
            AvionController::VolverActivar($id);
            $ObjVuelo->getAvionIdAvion();
            $ObjVuelo->setEstado("Realizado");
            $ObjVuelo->editar($_GET['IdVuelo']);
            //var_dump($ObjVuelo);

            header("Location: ../Vista/gestionarVuelos.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/gestionarVuelos.php?respuesta=error");
            echo "Error";
        }
    }


    static public function VerpersonalVuelos()
    {
        $arrayVuelo = vuelo::getAll();
        //var_dump($arrayVuelo);
        $htmlTable = "";

        if (count($arrayVuelo) >=1) {
            foreach ($arrayVuelo as $ObjVuelo) {
                if($ObjVuelo->getEstado() =="Inactivo"){
                    $htmlTable .= "<tr>";
                    $htmlTable .= "<td>" . $ObjVuelo->getidVuelo() . "</td>";
                    $htmlTable .= "<td>" . $ObjVuelo->getFecha() . "</td>";
                    $htmlTable .= "<td>" . $ObjVuelo->getHora() . "</td>";
                    $hora = $ObjVuelo->getHora();
                    //echo "La hora es:".$hora;
                    $htmlTable .= "<td>" . $ObjVuelo->getTipo() . "</td>";
                    $id = $ObjVuelo->getAvionIdAvion();
                    $avion = avion::buscarForId($id);
                    $htmlTable .= "<td>" . $avion->getNombre() . "</td>";

                    //Llamar al Id de Rutas para Origen
                    $idr = $ObjVuelo->getRutasIdRutas();
                    $Ruta = Rutas::buscarForId($idr);
                    $idOrigen = $Ruta->getOrigen();
                    $iddestino = $Ruta->getDestino();
                    $ciudad = Ciudades::buscarForId($idOrigen);
                    $Origen = $ciudad->getCiudad();
                    $htmlTable .= "<td> $Origen</td>";
                    $ciudad2 = Ciudades::buscarForId($iddestino);
                    $Destino = $ciudad2->getCiudad();
                    $htmlTable .= "<td> $Destino</td>";
                    $icons = "<a class='btn btn-primary'  href='verPersonalVuelo.php?IdVuelo=" . $ObjVuelo->getidVuelo() . "' title=''>Ver Personal</a>";
                    $htmlTable .= "<td>$icons</td>";
                    $htmlTable .= "</tr>";
                }
            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay vuelos Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }


    static public function asignarVuelo()
{
    $arrayVuelo = vuelo::getAll();
    //var_dump($arrayVuelo);
    $htmlTable = "";

    if (count($arrayVuelo) >=1) {
        foreach ($arrayVuelo as $ObjVuelo) {
            if($ObjVuelo->getEstado() =="Inactivo"){
            $htmlTable .= "<tr>";
            $htmlTable .= "<td>" . $ObjVuelo->getidVuelo() . "</td>";
            $htmlTable .= "<td>" . $ObjVuelo->getFecha() . "</td>";
            $htmlTable .= "<td>" . $ObjVuelo->getHora() . "</td>";
            $hora = $ObjVuelo->getHora();
            //echo "La hora es:".$hora;
            $htmlTable .= "<td>" . $ObjVuelo->getTipo() . "</td>";
            $id = $ObjVuelo->getAvionIdAvion();
            $avion = avion::buscarForId($id);
            $htmlTable .= "<td>" . $avion->getNombre() . "</td>";

            //Llamar al Id de Rutas para Origen
            $idr = $ObjVuelo->getRutasIdRutas();
            $Ruta = Rutas::buscarForId($idr);
            $idOrigen = $Ruta->getOrigen();
            $iddestino = $Ruta->getDestino();
            $ciudad = Ciudades::buscarForId($idOrigen);
            $Origen = $ciudad->getCiudad();
            $htmlTable .= "<td> $Origen</td>";
            $ciudad2 = Ciudades::buscarForId($iddestino);
            $Destino = $ciudad2->getCiudad();
            $htmlTable .= "<td> $Destino</td>";
            $icons = "<a class='btn btn-primary'  href='../Controlador/PersonaController.php?action=personahasvuelo&IdVuelo=" . $ObjVuelo->getidVuelo() . "' title='Bootstrap 3 themes generator'>Asginar a este Vuelo</a>";
            $htmlTable .= "<td>$icons</td>";
            $htmlTable .= "</tr>";
        }
        }
        return $htmlTable;
    }else{
        $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
        $htmlTable .= "<td>No hay vuelos Disponibles </td>";
        $htmlTable .= "</tr>";
        return $htmlTable;
    }
}


    static public function gestionarVuelo()
    {
        $arrayVuelo = vuelo::getAll();
        //var_dump($arrayVuelo);
        $htmlTable = "";

        if (count($arrayVuelo) >=1) {
            foreach ($arrayVuelo as $ObjVuelo) {
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>" . $ObjVuelo->getidVuelo() . "</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getFecha() . "</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getHora() . "</td>";
                $hora = $ObjVuelo->getHora();
                echo "La hora es:".$hora;
                $htmlTable .= "<td>" . $ObjVuelo->getTipo() . "</td>";
                $id = $ObjVuelo->getAvionIdAvion();
                $avion = avion::buscarForId($id);
                $htmlTable .= "<td>" . $avion->getNombre() . "</td>";

                //Llamar al Id de Rutas para Origen
                $idr = $ObjVuelo->getRutasIdRutas();
                $Ruta = Rutas::buscarForId($idr);
                $idOrigen = $Ruta->getOrigen();
                $iddestino = $Ruta->getDestino();
                $ciudad = Ciudades::buscarForId($idOrigen);
                $Origen = $ciudad->getCiudad();
                $htmlTable .= "<td> $Origen</td>";
                $ciudad2 = Ciudades::buscarForId($iddestino);
                $Destino = $ciudad2->getCiudad();
                $htmlTable .= "<td> $Destino</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getEstado() . "</td>";

                $icons = "";
                if ($ObjVuelo->getEstado() == "Inactivo") {
                    $icons .= "<a data-toggle='tooltip' title='Activar Vuelo' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' 
                    href='../Controlador/VueloController.php?action=ActivarVuelo&IdVuelo=" . $ObjVuelo->getidVuelo() . "'><i class='fa fa-times'></i></a>";
                    if ($ObjVuelo->getTipo() =="Ida-Vuelta") {
                        $icons .= "<a class='btn btn-primary' title='Agregar Combo' href='crearCombo.php'><i class='icon_plus_alt2'></i></a>";
                    }
                    $icons .= "<a class='btn btn-primary' href='../Controlador/VueloController.php?action=RealizadoVuelo&IdVuelo=" . $ObjVuelo->getidVuelo() . "' title='Bootstrap 3 themes generator'>Realizar Vuelo</a>";

                } else if ($ObjVuelo->getEstado() == "Activo") {
                    $icons .= "<a data-toggle='tooltip' title='Inactivar Vuelo' data-placement='top' class='btn btn-social-icon btn-success newTooltip' 
                    href='../Controlador/VueloController.php?action=InactivarVuelo&IdVuelo=" . $ObjVuelo->getidVuelo() ."'><i class='fa fa-check'></i></a>";
                    if ($ObjVuelo->getTipo() =="Ida-Vuelta") {
                        $icons .= "<a class='btn btn-primary' title='Agregar Combo' href='crearCombo.php?idvuelo=".$ObjVuelo->getidVuelo()."'><i class='icon_plus_alt2'></i></a>";
                    }
                    $icons .= "<a class='btn btn-primary' href='../Controlador/VueloController.php?action=RealizadoVuelo&IdVuelo=" . $ObjVuelo->getidVuelo() . "' title='Bootstrap 3 themes generator'>Realizar Vuelo</a>";
                }else if ($ObjVuelo->getEstado() == "Realizado") {
                    $icons = "<a class='btn btn-danger' disabled href='../Controlador/VueloController.php?action=RealizadoVuelo&IdVuelo=" . $ObjVuelo->getidVuelo() . "' title='Bootstrap 3 themes generator'>Vuelo Realizado</a>";
                }
                $htmlTable .= "<td>$icons</td>";
                //$htmlTable .= "<a class='btn btn-primary'href='crearAerolinea.php'><i class='icon_plus_alt2'></i>Agregar Avion</a>";
                //$htmlTable .= "</td>";
                $htmlTable .= "</tr>";

            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay vuelos Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }


    static public function VuelosIncio()
    {
        $arrayVuelo = vuelo::getAll();
        $vuelosActivos = array();
        //var_dump($arrayVuelo);
        $htmlTable = "";

        foreach ($arrayVuelo as $Activo) {
            if ($Activo->getEstado() == "Activo") {
                $vuelo = new vuelo();
                $vuelo = $Activo->getidVuelo();
                array_push($vuelosActivos, $vuelo);
            }
        }
        if (count($vuelosActivos) >= 1) {
            foreach ($vuelosActivos as $Obj) {
                $ObjVuelo = vuelo::buscarForId($Obj);
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>" . $ObjVuelo->getidVuelo() . "</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getFecha() . "</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getHora() . "</td>";
                $htmlTable .= "<td>" . $ObjVuelo->getTipo() . "</td>";

                //Llama al id del Avion
                $id = $ObjVuelo->getAvionIdAvion();
                $avion = avion::buscarForId($id);
                $id2 = $avion->getAerolineaIdAerolinea();
                $aero = aerolinea::buscarForId($id2);
                $htmlTable .= "<td>" . $aero->getRazonSocial() . "</td>";

                //Llamar al Id de Rutas para Origen
                $idr = $ObjVuelo->getRutasIdRutas();
                $Ruta = Rutas::buscarForId($idr);
                $idOrigen = $Ruta->getOrigen();
                $iddestino = $Ruta->getDestino();
                $ciudad = Ciudades::buscarForId($idOrigen);
                $Origen = $ciudad->getCiudad();
                $htmlTable .= "<td> $Origen</td>";
                $ciudad2 = Ciudades::buscarForId($iddestino);
                $Destino = $ciudad2->getCiudad();
                $htmlTable .= "<td> $Destino</td>";

                $htmlTable .= "<td>" . $ObjVuelo->getEstado() . "</td>";
                $icons = "<a class='btn btn-success btn-sm' href='gestionarClientes.php?idVuelo=".$ObjVuelo->getidVuelo()."' title='Bootstrap 3 themes generator'>Vender Vuelo</a>";
                $htmlTable .= "<td>$icons</td>";
                $htmlTable .= "</tr>";
            }
            return $htmlTable;
        }else {

            $htmlTable .= "<tr style='color:#4da944;'>";
            $htmlTable .= "<td>No hay vuelos Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }
}
