<?php
require_once (__DIR__.'/../Modelo/Clientes.php');
require("../Controlador/ClientesController.php");
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
    <link rel="shortcut icon" href="NiceAdmin/img/avion42.ico">

    <title>Cliente </title>

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
					<h3 class="p"<i class="icon_"><img src="NiceAdmin/img/Iconos/per.png"></i>Editar Cliente</h3>

				</div>
			</div>

              <?php if(!empty($_GET['respuesta'])){ ?>
                  <?php if ($_GET['respuesta'] == "correcto"){ ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>El Cliente!</strong> se ha creado correctamente.
                      </div>
                  <?php }else {?>
                      <div class="alert alert-danger alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>Error!</strong> No se pudo ingresar el Cliente intentalo nuevamente <br>Verifique que todos los campos este completados!!
                      </div>
                  <?php } ?>
              <?php } ?>

              <?php if(!empty($_GET["idPasajero"]) && isset($_GET["idPasajero"])) { ?>
                  <?php
                  $ObjClientes = Clientes::buscarForId($_GET["idPasajero"]);
                  //var_dump($ObjRuta);
              }
              ?>

              <!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-horizontal form-label-left" method="post" action="../Controlador/ClientesController.php?action=editar" >

                                      <input class="" hidden value="<?php echo $ObjClientes->getIdPasajero(); ?>" id="idPasajero" name="idPasajero" type="number" required />

                                      <div class="form-group ">
                                          <label for="curl" class="control-label col-lg-2">Tipo Documento</label>
                                          <div class="col-lg-10">                                   
                                              <select id="Tipo_Documento" name="Tipo_Documento" class="form-control input-sm m-bot15">
                                              <option>C.C</option>
                                              <option>T.I</option>
                                              <option>C.E</option>
                                              <option>R.C</option>
                                              <option>Otros</option>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Documento <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjClientes->getDocumento(); ?>" id="Documento" name="Documento" type="number" required />

                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Nombre <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjClientes->getNombre() ?>" id="Nombre" name="Nombre" type="text" required />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Apellido <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjClientes->getApellido() ?>" id="Apellido" name="Apellido" type="text" required />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Telefono <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjClientes->getTelefono(); ?>" id="Telefono" name="Telefono" type="number" required />
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-2">Direccion <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control " value="<?php echo $ObjClientes->getDireccion(); ?>" id="Direccion" name="Direccion" type="text" required />
                                          </div>
                                      </div>
                                                                         
                                    
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="boton" type="submit" >Registrar e ir a Crear Tiquete</button>
                                              <button class="boton" type="button"><a href="index.php">Cancelar</a></button>
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
            <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
  </section>
  <!-- container section end -->
<script type="text/javascript">
  $(document).ready(function () {
    $("#input1").keyup(function () {
        var value = $(this).val();
        $("#input2").val(value);
    });
});
</script>
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
