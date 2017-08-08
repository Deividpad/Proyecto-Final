<?php
//session_start();
if(!isset($_SESSION))
{
    session_start();
}
//header("Location: ../Vista/crearTiquete.php?respuesta=correcto");
require_once (__DIR__.'/../Modelo/Tiquete.php');
require_once (__DIR__.'/../Modelo/Vuelo.php');
require_once (__DIR__.'/../Modelo/Avion.php');
require_once (__DIR__.'/../Modelo/AsientosTickete.php');
require_once (__DIR__.'/../Modelo/Rutas.php');
//header("Location: ../Vista/crearTiquete.php?respuesta=correcto");

if(!empty($_GET['action'])){
    TiqueteController::main($_GET['action']);
}else{
    //echo "No se encontro ninguna accion...";
}

class TiqueteController
{
    static function main($action)
    {
        if ($action == "crear") {
            TiqueteController::crear();
        } else if ($action == "editar") {
            TiqueteController::editar();
        } else if ($action == "buscarID") {
            TiqueteController::buscarID();
        } else if ($action == "gestionarVuelo") {
            TiqueteController::gestionarVuelo();
        } else if ($action == "InactivarVuelo") {
            TiqueteController::InactivarVuelo();
        } else if ($action == "ActivarVuelo") {
            TiqueteController::ActivarVuelo();
        } else if ($action == "RealizadoVuelo") {
            TiqueteController::RealizadoVuelo();
        }else if ($action == "si") {
            TiqueteController::si();
        }

    }

    static public function si(){
        if(empty($_SESSION["arr"])){
            $_SESSION["arr"] = array();
        }

        if(isset($_SESSION["arr"])){
            $d = $_GET["Nombre"];
            array_push($_SESSION["arr"],$d);


        }
        //echo $_SESSION["arr"];
        //var_dump($_SESSION["arr"]);
        //$_SESSION["arr"] = array();
        /*echo "Los numeros ".$e;
        $d = $_GET["Nombre"];
        echo "La varsdsdiables es".$d;
        $arr = array();
        $_SESSION["arr"] = array();
        array_push($_SESSION["arr"],$d);
        //echo "sii"
        var_dump($_SESSION["arr"]);*/
    }

    static public function crear()
    {


                    if(!empty($_SESSION["arr"])){
                    try {

                        $arrayTiquete = array();
                        $arrayTiquete['Clase'] = $_POST['Clase'];
                        //$arrayTiquete['Clase'] = "Negocios";
                        $arrayTiquete['Numero_Asiento'] = 0;
                        $Valor = self::Precio();
                        $arrayTiquete['Valor'] = $Valor;
                        $arrayTiquete['Estado'] = "Activo";
                        if (!empty($_SESSION['idCliente'])){
                            $arrayTiquete['Pasajero_idPasajero'] = $_SESSION['idCliente'];
                        }
                        if (!empty($_SESSION["idc2"])){
                            //echo "La de la tabla tiene algo";
                            $arrayTiquete['Pasajero_idPasajero'] = $_SESSION['idc2'];
                        }
                        $arrayTiquete['Vuelo_idVuelo'] = $_SESSION["dd"];
                        $arrayTiquete['Combo_idCombo'] = 1;
                        $Vuelo = new Tiquete($arrayTiquete);
                        $Vuelo->insertar();
                        //var_dump($Vuelo);
                        $id = Tiquete::getid();
                        $cont=0;
                        foreach ($_SESSION["arr"] as $valor) {
                            $cont = 55;
                            $arr = array();
                            $arr['Vuelo_idVuelo'] = $_SESSION["dd"];
                            $arr['Tiquete_idTiquete'] = $id;
                            $arr['NAsiento'] = $valor;
                            $arr['Clase'] = "Negocios";
                            $b = new AsientosTickete($arr);
                            $b->insertar();
                            $cont++;
                            //echo $cont;
                        }
                        header("Location: ../Vista/crearTiquete.php?respuesta=correcto");




                    } catch (Exception $e) {
                        //var_dump($e);
                        header("Location: ../Vista/crearTiquete.php?respuesta=error");
                    }

                    }else{
                         header("Location: ../Vista/crearTiquete.php?respuesta=error");
                    }


    }

    static public function Precio(){
        //Buscar Asientos Avion
        $vuelo = Vuelo::buscarForId($_SESSION["dd"]);
        $idav = $vuelo->getAvionIdAvion();
        $avion = Avion::buscarForId($idav);
        $nego = $avion->getAsientoNegociosFin();
        $sillas = $avion->getCapacidadSilla();
        $inicioeco =$nego+1;



        //Buscar Precio en Rutas
        $idruta = $vuelo->getRutasIdRutas();
        $ruta = Rutas::buscarForId($idruta);
        $precionego = $ruta->getPrecioNegocios();
        $precioecono = $ruta->getPrecioEconomico();

        $contnego = 0;
        $conteco = 0;
        foreach ($_SESSION["arr"] as $valor){
            if($valor <= $nego){
                $contnego++;
            }
            if($valor >=$inicioeco && $valor <= $sillas){
                $conteco++;
            }
        }

        $precionego = $precionego*$contnego;
        $precioeco = $precioecono*$conteco;
        $preciofinal = $precionego+$precioeco;
        return $preciofinal;


    }

    static public function tt(){



    }
    static public function AsientosTiquete()
    {

        //echo "La Sesion de vuelo".$_SESSION["dd"];
        $arrayVuelo = vuelo::buscarForId($_SESSION["dd"]);
        //var_dump($arrayVuelo);
        $idavion = $arrayVuelo->getAvionIdAvion();


        $arrayAvion = Avion::buscarForId($idavion);
        $capacidadSillas = $arrayAvion->getCapacidadSilla();
        $division = $capacidadSillas/4;
        $claseNegocios = $arrayAvion->getAsientoNegociosFin();
        //echo "asfasdf".$claseNegocios;
        //var_dump($arrayAvion);
        $htmlTable = "";

        $htmlTable .= "<div class='row'>";

        $cont =0;

        $htmlTable .= "<div class='col-md-3'>";
        $htmlTable .= "<table class=\"table\" style='width: 40px; color: #00a0df; border: solid; ';>";
        $htmlTable .= "<tbody>";


        for ($i = 1; $i<= $division; $i++) {
            $htmlTable .= "<tr style='border: #0b97c4; border-spacing: 10px 5px; color: white;' align='center'>";

            for ($j = 1; $j<= 4; $j++) {
                if($cont <= $claseNegocios){
                    $cont++;
                    $EstaLibre = AsientosTickete::isFreeTicket($_SESSION["dd"],$cont);
                    if($EstaLibre){
                        if($cont <= $claseNegocios){
                            $htmlTable .= "<td style='border: solid; background-color: #3b5998;  color: black;' class='puestoNum' data-num-asiento='$cont' align='center'><img src='../Vista/NiceAdmin/img/silla.png'> $cont</td>";
                        }
                    }else{
                        $htmlTable .= "<td style='border: solid; background-color: #c7254e; color: black;' class='puestoNum' data-num-asiento='$cont' align='center'><img src='../Vista/NiceAdmin/img/silla.png'> $cont</td>";
                    }
                }

            }
            $htmlTable .= "</tr>";
        }

        $htmlTable .= "</tbody>";
        $htmlTable .= "</table>";
        $htmlTable .= "</div>";






        
        // ----------------------------------------- //

        //echo "La Sesion de vuelo".$_SESSION["dd"];
        $arrayVuelo = vuelo::buscarForId($_SESSION["dd"]);
        //var_dump($arrayVuelo);
        $idavion = $arrayVuelo->getAvionIdAvion();


        $arrayAvion = Avion::buscarForId($idavion);
        $capacidadSillas = $arrayAvion->getCapacidadSilla();
        $division = $capacidadSillas/4;
        $claseNegocios = $arrayAvion->getAsientoNegociosFin();
        //echo "asfasdf".$claseNegocios;
        //var_dump($arrayAvion);

        $salto = 0;

        $htmlTable .= "<div class='col-md-3'>";
        $htmlTable .= "<table class=\"table\" style='width: 40px; color: #00a0df; border: solid; ';>";
        $htmlTable .= "<tbody>";

        $cont =$claseNegocios;

        for ($i = 1; $i<= $division; $i++) {
            $htmlTable .= "<tr style='border: #0b97c4; border-spacing: 10px 5px; color: white;' align='center'>";

            for ($j = 1; $j<=4; $j++) {
                if($cont < $capacidadSillas){

                    $cont++;
                    $EstaLibre = AsientosTickete::isFreeTicket($_SESSION["dd"],$cont);
                    if($EstaLibre){
                        if($cont <= $claseNegocios){
                            $htmlTable .= "<td style='border: solid; background-color: #3b5998;  color: black;' class='puestoNum' data-num-asiento='$cont' align='center'><img src='../Vista/NiceAdmin/img/silla.png'> $cont</td>";
                        }else {
                            $htmlTable .= "<td style='border: solid; background-color: #8A6343; color: black;' class='puestoNum'  data-num-asiento='$cont' align='center'><img src='../Vista/NiceAdmin/img/silla.png'>$cont</td>";
                        }
                    }else{
                        $htmlTable .= "<td style='border: solid; background-color: #c7254e; color: black;' class='puestoNum' data-num-asiento='$cont' align='center'><img src='../Vista/NiceAdmin/img/silla.png'> $cont</td>";
                    }
                }
                $salto++;
            }
            $htmlTable .= "</tr>";

            if($salto >= 20){
                $htmlTable .= "</tbody>";
                $htmlTable .= "</table>";
                $htmlTable .= "</div>";

                $htmlTable .= "<div class='col-md-3' style='text-align: center'>";
                $htmlTable .= "<table class=\"table\" style='width: 40px; color: #00a0df; border: solid; ';>";
                $htmlTable .= "<tbody>";
                $salto = 1;
            }


        }


        /*$htmlTable .= "<div class='col-md-3'>";
        $htmlTable .= "<table class=\"table\" style='width: 40px; color: #00a0df; border: solid; ';>";
        for ($j = 1; $j<=6; $j++){
        $htmlTable .= "<td>$j</td>";
        } //Cierra Row*/




        $htmlTable .= "</tbody>";
        $htmlTable .= "</table>";
        $htmlTable .= "</div>"; //Cierra Columna

        $htmlTable .= "</div>"; //Cierra Row

        return $htmlTable;


    }

}
