<?php
require_once('tcpdf_include.php');

require "../../Controlador/TiqueteController.php";
require "../../Modelo/Clientes.php";
require "../../Modelo/Ciudades.php";
require "../../Modelo/Aerolinea.php";
//require "../../Modelo/AsientosTickete.php";

//$DataTiquete = TiqueteController::buscarID($_SESSION["idTiquete"]);
$id = Tiquete::getid();
//Llamar Nombre de el Pasajero
$allTiqute = Tiquete::buscarForId($id);
//var_dump($all);

$_SESSION["arr"] = array();

//Datos TiqeteAsientos
$allAsientoTickete = AsientosTickete::TiqueteAsientos2($id);

//Datos Pasajero
$idPasajero = $allTiqute->getPasajeroIdPasajero();
$allPasajero = Clientes::buscarForId($idPasajero);

//Datos Vuelo
$idVuelo = $allTiqute->getVueloIdVuelo();
$allVuelo = Vuelo::buscarForId($idVuelo);


//Datos Avion
$idAvion = $allVuelo->getAvionIdAvion();
$allAvion = avion::buscarForId($idAvion);

//Datos AeroLinea
$idAero = $allAvion->getAerolineaIdAerolinea();
$allAero = Aerolinea::buscarForId($idAero);


//Datos Rutas
$idRutas = $allVuelo->getRutasIdRutas();
$allRutas = Rutas::buscarForId($idRutas);


$idOrigen = $allRutas->getOrigen();
$idDestino = $allRutas->getDestino();

//Datos Ciudades
$idCiudadOrigen = Ciudades::buscarForId($idOrigen);

$idCiudadDestino = Ciudades::buscarForId($idDestino);

$a = 34;
$b=  56;







// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Erika Numpaque');
$pdf->SetTitle('Generar Tiquete');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, /*PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.*/'023' /*PDF_HEADER_STRING*/);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);¨

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);*/

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage('L', 'A4');
//----------------------

$pdf->Image('images/aerolinea7.png', 2,5,380,190, '', false);


//for ($i =0;$i<2;$i++){
 //   $html='
//    <br><br><label style="text-transform:uppercase; font-size:18px; color:#0A10FF">Aerolinea: '.$allAero->getRazonSocial().'</label><br><br>
 //   ';
//}



$html='
<br><br><label style="text-transform:uppercase; font-size:18px; color:white">Aerolinea: '.$allAero->getRazonSocial().'</label><br><br>
<!--<label style="text-transform:uppercase; font-size:18px; color:#340DFF">Clase</label><br><br>-->
<br><br><label style="text-transform:uppercase; font-size: 16px; color:black ;padding:30px 20px;">'.'&#160;&#160;&#160;&#160;'.$allPasajero->getNombre().'&#160;'.$allPasajero->getApellido().'</label><br><br><br><br>
<br><br><br><br><label style="text-transform:uppercase; font-size:22px; color:black">Asiento:'.$allAsientoTickete.'</label><br><br>
<label style="text-transform:uppercase; font-size:15px; color:black">Valor: $'.'&#160;&#160;&#160;&#160;'. $allTiqute->getValor().'</label><br><br>
<label style="text-transform:uppercase; font-size:20px; color:black">Vuelo: '.$allTiqute->getVueloIdVuelo().'</label><br><br>
<label style="text-transform:uppercase; font-size:18px; color:black">Hora: '.$allVuelo->getHora().'</label><br><br>

<label style="text-transform:uppercase; font-size:18px; color:black">Origen: '.$idCiudadOrigen->getCiudad().'</label>
<!--<img src="images/avion12.png" width="100" height="80" /><br>-->
<label style="text-transform:uppercase; font-size:18px; color:black">Destino: '.$idCiudadDestino->getCiudad().'</label><br><br>
';

    

    

// CODE 128 AUTO
/*$style = array(
    //'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
//$style['fgcolor'] = array(0,64,127);
$style['position'] = '';
$style['stretch'] = false; // disable stretch
$style['fitwidth'] = true; // disable fitwidth

//$pdf->Cell(0, 0, 'CODE 128 AUTO', 0, 1);

$style['position'] = 'R';
$pdf->write1DBarcode('987267301211239', 'C128', '', '', '', 24, 0.5, $style, 'N');
$pdf->Ln();
*/
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();
ob_end_clean();
//Close and output PDF document
$pdf->Output('Tiquete.pdf', 'I');