<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once (__DIR__.'/../Modelo/Rutas.php');
require_once (__DIR__.'/../Modelo/Ciudades.php');

if(!empty($_GET['action'])){
    RutasController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
}
class RutasController
{

    static function main($action){
        if ($action == "crear"){
            RutasController::crear();
        }else if ($action == "editar"){
            RutasController::editar();
        }else if ($action == "buscarID"){
            RutasController::buscarID();
        }else if ($action == "gestionarRutas"){
            RutasController::gestionarRutas();
        }else if ($action == "ActivarRuta"){
            RutasController::ActivarRuta();
        }else if ($action == "InactivarRuta"){
            echo "Entro al metodo";
            RutasController::InactivarRuta();
        }
    }


    static public function crear(){
            if ($_POST['idCiudades'] != $_POST['idCiudades2'] ) {
                try {
                    $arrayRuta = array();
                    $arrayRuta['Origen'] = $_POST['idCiudades'];
                    $arrayRuta['Destino'] = $_POST['idCiudades2'];
                    $arrayRuta['Duracion'] = $_POST['Hora'];
                    $arrayRuta['Precio_Negocios']= $_POST['PrecioNegocio'];
                    $arrayRuta['Precio_Economico']= $_POST['PrecioEconomico'];
                    $arrayRuta['Estado'] = $_POST['Estado'];
                    $Rutas = new Rutas($arrayRuta);
                    //var_dump($arrayAvion);
                    $Rutas->insertar();
                    header("Location: ../Vista/crearRuta.php?respuesta=correcto");
                } catch (Exception $e) {
                    echo "Error seleccine";
                    header("Location: ../Vista/crearRuta.php?respuesta=error");
                }
            }else{
                header("Location: ../Vista/crearRuta.php?respuesta=error");
                echo "Error misma ciudad";
            }
    }

    static public function editar (){
        try {
            $arrayRuta = array();
            $arrayRuta['Origen'] = $_POST['idCiudades'];
            $arrayRuta['Destino'] = $_POST['idCiudades2'];
            $arrayRuta['Duracion'] = $_POST['Hora'];
            $arrayRuta['Precio_Negocios'] = $_POST['PrecioNegocio'];
            $arrayRuta['Precio_Economico'] = $_POST['PrecioEconomico'];
            $arrayRuta['Estado'] = $_POST['Estado'];
            $arrayRuta['idRutas'] = $_POST['idRuta'];
            $ruta = new Rutas($arrayRuta);
            //var_dump($arrayRuta);
            $ruta->editar();
            echo "Edito";
            header("Location: ../Vista/gestionarRutas.php");
        } catch (Exception $e) {
            //header("Location: ../Vista/editarRuta.php?respuesta=error");
            echo "Erorr";
        }
    }

    static public function ActivarRuta (){

        try {
            $ObjRutas = Rutas::buscarForId($_GET['IdRuta']);
            $ObjRutas->setEstado("Activa");
            $ObjRutas->editar($_GET['IdRuta']);
            header("Location: ../Vista/gestionarRutas.php");
        } catch (Exception $e) {
            header("Location: ../Vista/gestionarRutas.php");
            echo "Error este es ";
        }
    }

    static public function InactivarRuta (){

        try {
            echo "entro al try";
            echo "La id es:".$_GET['IdRuta'];
            $ObjRutas = Rutas::buscarForId($_GET['IdRuta']);
            $ObjRutas->setEstado("Inactiva");
            $ObjRutas->editar($_GET['IdRuta']);

            header("Location: ../Vista/gestionarRutas.php");
        } catch (Exception $e) {
            header("Location: ../Vista/gestionarRutas.php");
        }
    }

    static public function gestionarRutas (){
        $arrayRutas = Rutas::getAll();
        //var_dump($arrayAvion);
        $htmlTable ="";

        if (count($arrayRutas) >=1) {
            foreach ($arrayRutas as $ObjRutas) {
                $htmlTable .= "<tr>";
                $htmlTable .= "<td>" . $ObjRutas->getIdRutas() . "</td>";
                $o =$ObjRutas->getOrigen();
                $ciudades = Ciudades::buscarForId($o);
                $origen = $ciudades->getCiudad();
                $htmlTable .= "<td> $origen</td>";

                $d = $ObjRutas->getDestino();
                $ciudad = Ciudades::buscarForId($d);
                $destino = $ciudad->getCiudad();
                $htmlTable .= "<td>$destino</td>";
                $htmlTable .= "<td>" . $ObjRutas->getDuracion() . "</td>";
                $htmlTable .= "<td>" . $ObjRutas->getPrecioNegocios() . "</td>";
                $htmlTable .= "<td>" . $ObjRutas->getPrecioEconomico() . "</td>";
                $htmlTable .= "<td>" . $ObjRutas->getEstado() . "</td>";

                $icons = "";
                if ($ObjRutas->getEstado() == "Inactiva") {
                    $icons .= "<a data-toggle='tooltip' title='Activar Ruta' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' 
                    href='../Controlador/RutasController.php?action=ActivarRuta&IdRuta=" . $ObjRutas->getIdRutas() . "'><i class='fa fa-times'></i></a>";
                    $icons .= "<a href='../Vista/editarRuta.php?idRuta=".$ObjRutas->getIdRutas()."' type='button' data-toggle='tooltip' title='Actualizar' <i class=\"icon_\"><img src=\"NiceAdmin /img/i.from/edi.png\"></i></i></a>";
                } else if ($ObjRutas->getEstado() == "Activa") {
                    $icons .= "<a data-toggle='tooltip' title='Inactivar Ruta' data-placement='top' class='btn btn-social-icon btn-success newTooltip' 
                    href='../Controlador/RutasController.php?action=InactivarRuta&IdRuta=" . $ObjRutas->getIdRutas() . "'><i class='fa fa-check'></i></a>";
                    $icons .= "<a href='../Vista/editarRuta.php?idRuta=".$ObjRutas->getIdRutas()."' type='button' data-toggle='tooltip' title='Actualizar' <i class=\"icon_\"><img src=\"NiceAdmin /img/i.from/edi.png\"></i></i></a>";
                }

                $htmlTable .= "<td>" . $icons . "</td>";
                $htmlTable .= "</tr>";

            }
            return $htmlTable;
        }else{
            $htmlTable .= "<tr style='color: #009da7; background-color: #0e2e42'>";
            $htmlTable .= "<td>No hay Rutas Disponibles </td>";
            $htmlTable .= "</tr>";
            return $htmlTable;
        }
    }


    static public function SelectRutas ($isRequired=true, $id="Rutas_idRutas", $nombres="Rutas_idRutas", $class="")
    {
        $arrayRutas = Rutas::getAll(); /*  */
        $rutasactivos = array();
        $htmlSelect = "";
        $htmlSelect .= "<select " . (($isRequired) ? "required" : "") . " id= '" . $id . "' name='" . $nombres . "' class='" . $class . "'>";

        foreach ($arrayRutas as $Acitvo) {
            if ($Acitvo->getEstado() == "Activa") {
                $ruta = new Rutas();
                $ruta = $Acitvo->getIdRutas();
                array_push($rutasactivos, $ruta);
                //var_dump($rutasactivos);
            }
        }
        if (count($rutasactivos) >= 1) {
            foreach ($rutasactivos as $obj) {
                $ObjRutas = Rutas::buscarForId($obj);

                //Lamar al origen
                $o =$ObjRutas->getOrigen();
                $ciudades = Ciudades::buscarForId($o);
                $origen = $ciudades->getCiudad();

                //Llamar al Destino
                $d = $ObjRutas->getDestino();
                $ciudad = Ciudades::buscarForId($d);
                $destino = $ciudad->getCiudad();
                $htmlSelect .= "<option value='" . $ObjRutas->getIdRutas() . "' id='" . $ObjRutas->getIdRutas() . "'>$origen-$destino</option>";
            }
            $htmlSelect .= "</select>";
            return $htmlSelect;
        } else {
            $htmlSelect .= "<option>No hay Rutas Disponibles</option>";
            $htmlSelect .= "</select>";
            return $htmlSelect;
        }
    }


}