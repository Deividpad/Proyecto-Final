<?php
require_once (__DIR__.'/../Modelo/Personal.php');
require("../Controlador/PersonaController.php");
session_start();
if (empty($_SESSION['idUsuario'])){
    header("Location: login.php");
}else
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Personal </title>

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
      <link rel="stylesheet" href="NiceAdmin/css/estilos.css">
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
                      <h3 class="p" style="color: black; "><i class="icon_"><img src="NiceAdmin/img/Iconos/p1.png"></i> Editar Personal<i class="icon_"><img src="NiceAdmin/img/Iconos/p2.png"></i> </h3>
          <section class="wrapper">
                          <?php if(!empty($_GET['respuesta'])){ ?>
                              <?php if ($_GET['respuesta'] == "correcto"){ ?>
                                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button>
                                      <strong>La Persona!</strong> se ha creado correctamente.
                                  </div>
                              <?php }else {?>
                                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button>
                                      <strong>Error!</strong> No se pudo ingresar  intentalo nuevamente!!
                                  </div>
                              <?php } ?>
                          <?php } ?>

              <?php if(!empty($_GET["idPersonal"]) && isset($_GET["idPersonal"])) { ?>
                  <?php
                  $ObjPersona = Personal::buscarForId($_GET["idPersonal"]);
                  //var_dump($ObjRuta);
              }
              ?>

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <!-- Form validations -->
                          <div class="panel-body">
                              <div class="form">



                                  <form class="form-horizontal form-label-left" method="post" action="../Controlador/PersonaController.php?action=editar"  id="persona">

                                      <input class="" hidden value="<?php echo $ObjPersona->getidPersonal(); ?>" id="idPersonal" name="idPersonal" type="number" required />

                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Tipo</label>
                                          <div class="col-lg-10">
                                              <select id="Tipo_Documento" name="Tipo_Documento" class="form-control">
                                                  <option>C.C</option>
                                                  <option>T.I</option>
                                                  <option>C.E</option>
                                                  <option>R.C</option>
                                                  <option>Otros</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label  class="control-label col-lg-2 ">Documento <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/no.png"></i></label>
                                          <div class="col-lg-10">
                                             <input class="form-control " value="<?php echo $ObjPersona->getDocumento(); ?>" size="50" id="Documento" name="Documento"  type="tel" required onkeypress="return solonumeros(event)" /></span>
                                             <span></span>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Nombre <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/no.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjPersona->getNombre(); ?>" id="Nombre" name="Nombre" type="text" required onkeypress="return soloLetras(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Apellido <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/no.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjPersona->getApellido(); ?>" id="Apellido" name="Apellido" type="text" required onkeypress="return soloLetras(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Telefono <span class="required">* </span><i class="icon_"><img src="NiceAdmin/img/i.from/tel.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" value="<?php echo $ObjPersona->getTelefono(); ?>" id="Telefono"  name="Telefono" type="number" required onkeypress="return solonumeros(event)" />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Direccion <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/di.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjPersona->getDireccion(); ?>" id="Direccion" name="Direccion" type="text" required />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Correo <span class="required">*</span><i class="icon_"><img src="NiceAdmin/img/i.from/co.png"></i></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjPersona->getCorreo(); ?>" id="Correo" name="Correo" type="email" required />
                                          </div>
                                      </div>

                                      <!--div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Imagen <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " id="Correo" name="Correo" type="file" required />
                                          </div>
                                      </div-->

                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Cargo<i class="icon_"><img src="NiceAdmin/img/i.from/ca.png"></i></label>
                                          <div class="col-lg-10">
                                              <select id="Cargo" name="Cargo" class="form-control">
                                                  <option>Piloto</option>
                                                  <option>Copiloto</option>
                                                  <option>Auxiliar</option>
                                                  <option>Ingeniero-Vuelo</option>
                                                  <option>Azafata</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Rh<i class="icon_"><img src="NiceAdmin/img/i.from/rh.png"></i></label>
                                          <div class="col-lg-10">
                                              <select id="Rh" name="Rh" class="form-control">
                                                  <option>O+</option>
                                                  <option>B+</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="boton" type="submit">Actualizar<i class="icon_"><img src="NiceAdmin/img/i.from/en.png"></i> </button>
                                              <button class="boton" type="button">Cancelar<i class="icon_"><img src="NiceAdmin/img/i.from/sa.png"></i></button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </section>

              <!-- page end-->
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
