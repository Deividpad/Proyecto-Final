<?php
session_start();
require_once (__DIR__.'/../Modelo/Rutas.php');
if (empty($_SESSION['idUsuario'])){
    header("Location: login.php");
}else
    ?>
<?php require("../Controlador/RutasController.php");
require("../Controlador/CiudadesController.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="NiceAdmin/img/avion42.ico">

    <title>Rutas/Ciudades </title>

    <!-- Bootstrap CSS -->    
    <link href="NiceAdmin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="NiceAdmin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="NiceAdmin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="NiceAdmin/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="NiceAdmin/css/style.css" rel="stylesheet">
    <link href="NiceAdmin/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>

    <![endif]-->
      <link href="NiceAdmin/css/estilos.css" rel="stylesheet" />
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
         <?php require("snippers/menusuperior.php");?>
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <?php require("snippers/menuizquierdo.php");?>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="p"<i class="icon_"><img src="NiceAdmin/img/Iconos/rou.png"></i></i> Crear Ruta</h3>
					<!--<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Inicio</a></li>
						<li><i class="icon_document_alt"></i>Rutas/Ciudades</li>
						<li><i class="fa fa-files-o"></i>Crear Ruta</li>
					</ol>-->
				</div>
			</div>


              <?php if(!empty($_GET['respuesta'])){ ?>
                  <?php if ($_GET['respuesta'] == "correcto"){ ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>La Ruta!</strong> se ha creado correctamente.
                      </div>
                  <?php }else {?>
                      <div class="alert alert-danger alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>Error!</strong> No se pudo ingresar el Ruta intentalo nuevamente <br>Verifique que todos los campos este completados!!
                      </div>
                  <?php } ?>
              <?php } ?>




              <?php if(!empty($_GET["idRuta"]) && isset($_GET["idRuta"])) { ?>
                  <?php
                  $ObjRuta = Rutas::buscarForId($_GET["idRuta"]);
                  //var_dump($ObjRuta);
              }
              ?>


              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Ingrese los campos requeridos para crear la Ruta
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal"  method="post" action="../Controlador/RutasController.php?action=editar">



                                              <input class="" hidden value="<?php echo $ObjRuta->getIdRutas(); ?>" id="idRuta" name="idRuta" type="number" required />



                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Origen<span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/origen.png"></i></label>
                                          <div class="col-lg-10">
                                              <?php echo CiudadesController::SelectCiudades(true, "idCiudades","idCiudades","form-control")?>
                                          </div>
                                      </div>


                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Destino<i class="icon_"><img src="NiceAdmin/img/i.from/destino.png"></i></label>
                                          <div class="col-lg-10">
                                              <?php echo CiudadesController::SelectCiudades(true, "idCiudades2","idCiudades2","form-control")?>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Precio Negocios <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/din.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" value="<?php echo $ObjRuta->getPrecioNegocios(); ?>" id="PrecioNegocio" name="PrecioNegocio" type="number" required onkeypress="return solonumeros(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Precio Economico <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/din.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjRuta->getPrecioEconomico(); ?>" id="PrecioEconomico" name="PrecioEconomico" type="number" required onkeypress="return solonumeros(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Duración(Minutos) <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/re.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjRuta->getDuracion(); ?>" id="Hora"   name="Hora" min="1" max="20" type="number" required onkeypress="return solonumeros(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Estado<i class="icon_"><img src="NiceAdmin/img/i.from/estado.png"></i></label>
                                          <div class="col-lg-10">                                   
                                              <select id="Estado" name="Estado" class="form-control input-sm m-bot15">
                                              <option>Activa</option>
                                              <option>Inactiva</option>
                                          </select>
                                          </div>
                                      </div>                                       
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="boton" type="submit">Actualizar<img src="NiceAdmin/img/i.from/en.png"></i></button>
                                              <button class="boton" type="button" ><a href="gestionarRutas.php">Cancelar</a><img src="NiceAdmin/img/i.from/sa.jpg"></i></button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </section>
                  </div>
              </div>
              
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <div class="text-right">
        <div class="credits">
            <!-- 
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
            -->

            <script>
                function soloLetras(e){
                    key = e.keyCode || e.which;
                    tecla = String.fromCharCode(key).toLowerCase();
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                    especiales = "8-37-39-46";

                    tecla_especial = false
                    for(var i in especiales){
                        if(key == especiales[i]){
                            tecla_especial = true;
                            break;
                        }
                    }

                    if(letras.indexOf(tecla)==-1 && !tecla_especial){
                        return false;
                    }
                }
            </script>


            <script>
                function solonumeros(e){
                    key = e.keyCode || e.which;
                    tecla = String.fromCharCode(key).toLowerCase();
                    letras = " 1234567890";
                    especiales = "8-37-39-46";

                    tecla_especial = false
                    for(var i in especiales){
                        if(key == especiales[i]){
                            tecla_especial = true;
                            break;
                        }
                    }

                    if(letras.indexOf(tecla)==-1 && !tecla_especial){
                        return false;
                    }
                }
            </script>
            <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
  </section>
  <!-- container section end -->

    <!-- javascripts -->
    <script src="NiceAdmin/js/jquery.js"></script>
    <script src="NiceAdmin/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="NiceAdmin/js/jquery.scrollTo.min.js"></script>
    <script src="NiceAdmin/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="NiceAdmin/js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="NiceAdmin/js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="NiceAdmin/js/scripts.js"></script>    


  </body>
</html>
