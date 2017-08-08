<?php

if(!isset($_SESSION))
{
    session_start();
}
//session_start();
if (empty($_SESSION['idUsuario'])){
    header("Location: login.php");
}else
?>
<!DOCTYPE html>
<?php require "../Controlador/TiqueteController.php";?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="NiceAdmin/img/avion42.ico">

    <title>Creative - Bootstrap Admin Template</title>

    <!-- Bootstrap CSS -->
    <link href="NiceAdmin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="NiceAdmin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="NiceAdmin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="NiceAdmin/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="NiceAdmin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="NiceAdmin/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="NiceAdmin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="NiceAdmin/css/owl.carousel.css" type="text/css">
    <link href="NiceAdmin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="NiceAdmin/css/fullcalendar.css">
    <link href="NiceAdmin/css/widgets.css" rel="stylesheet">
    <link href="NiceAdmin/css/style.css" rel="stylesheet">
    <link href="NiceAdmin/css/style-responsive.css" rel="stylesheet" />
    <link href="NiceAdmin/css/xcharts.min.css" rel=" stylesheet">
    <link href="NiceAdmin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="NiceAdmin/css/datatables.min.css"/>
    <link rel="stylesheet" href="NiceAdmin/css/styletable.css"/>
    <!-- =======================================================
        Theme Name: NiceAdmin
        Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>
<!-- container section start -->
<section id="container" class="">


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

            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Asientos </h3>

                </div>
            </div>


            <div style="width: auto" id="resultadosE2">
                <button style="background-color: #5f646b; color: white;" class="btn btn-info" type="submit"><a href="crearTiquete.php">Validar Asientos</a> </button>
            </div>
            <div class="panel-heading" >
                <h2><i class="fa fa-flag-o red"></i><strong>Vuelos Activos</strong></h2>
                <div class="panel-actions">
                    <a href="index.php#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="index.php#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="index.php#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <!-- Today status end -->

            <div class="row" >
                <div id="generaldiv">
                    <div style="float: left; -webkit-background-size: cover;">
                        <h4 style="color: #0c0c0c">Asiento Negocios</h4>
                        <?php echo TiqueteController::AsientosTiquete(); ?>
                    </div>
                </div>
            </div>






            <?php $_SESSION["arr"] = array(); ?>

            </div><!--/col-->


            <!--Etiquetas de Redes Sociales-->

            <!--Etiquetas de Redes Sociales End-->




            <!-- statics end -->



        </section>

    </section>
    <!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->
<script src="NiceAdmin/js/jquery.js"></script>
<script src="NiceAdmin/js/jquery-ui-1.10.4.min.js"></script>
<script src="NiceAdmin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="NiceAdmin/js/jquery-ui-1.9.2.custom.min.js"></script>
<!-- bootstrap -->
<script src="NiceAdmin/js/bootstrap.min.js"></script>
<!-- nice scroll -->
<script src="NiceAdmin/js/jquery.scrollTo.min.js"></script>
<script src="NiceAdmin/js/jquery.nicescroll.js" type="text/javascript"></script>
<!-- charts scripts -->
<script src="NiceAdmin/assets/jquery-knob/js/jquery.knob.js"></script>
<script src="NiceAdmin/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="NiceAdmin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="NiceAdmin/js/owl.carousel.js" ></script>
<!-- jQuery full calendar -->
<<script src="NiceAdmin/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="NiceAdmin/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
<!--script for this page only-->
<script src="NiceAdmin/js/calendar-custom.js"></script>
<script src="NiceAdmin/js/jquery.rateit.min.js"></script>
<!-- custom select -->
<script src="NiceAdmin/js/jquery.customSelect.min.js" ></script>
<script src="NiceAdmin/assets/chart-master/Chart.js"></script>

<!--custome script for all page-->
<script src="NiceAdmin/js/scripts.js"></script>
<!-- custom script for this page-->
<script src="NiceAdmin/js/sparkline-chart.js"></script>
<script src="NiceAdmin/js/easy-pie-chart.js"></script>
<script src="NiceAdmin/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="NiceAdmin/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="NiceAdmin/js/xcharts.min.js"></script>
<script src="NiceAdmin/js/jquery.autosize.min.js"></script>
<script src="NiceAdmin/js/jquery.placeholder.min.js"></script>
<script src="NiceAdmin/js/gdp-data.js"></script>
<script src="NiceAdmin/js/morris.min.js"></script>
<script src="NiceAdmin/js/sparklines.js"></script>
<script src="NiceAdmin/js/charts.js"></script>
<script src="NiceAdmin/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="NiceAdmin/js/datatables.min.js"></script>
<script>

    //knob
    $(function() {
        $('#example').DataTable();
        $(".knob").knob({
            'draw' : function () {
                $(this.i).val(this.cv + '%')
            }
        })
    });

    //carousel
    $(document).ready(function() {
        <?php
        $AsientosTick = AsientosTickete::getAllPuestosVuelos($_SESSION["dd"]);
        $ArrTmpAsTicket = "[";
        foreach ($AsientosTick as $AsTicket){
            $ArrTmpAsTicket .= $AsTicket->getNAsiento().",";
        }
        $ArrTmpAsTicket .= "]";
        echo "var ocupados = $ArrTmpAsTicket;"
        ?>

        $(".puestoNum").click(function() {
            var id = $(this).data( "num-asiento" );

            if(ocupados.indexOf(id) !== -1){
                alert ("Este Asiento ya esta ocupado");
            }else{
                $(this).css( "background-color", "#c7254e" );
                //var s = document.getElementById("Nombre").value = id;
                //document.getElementById("Nombre").value;

                $.ajax({
                    url:"../Controlador/TiqueteController.php?action=si",
                    method: "GET",
                    data: { Nombre: id}
                })

                .done(function( data ) {
                    $("#resultadosE1").html(data);
                    ocupados.push(id);
                });
            }
        });


        $("#owl-slider").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

    /* ---------- Map ---------- */
    $(function(){
        $('#map').vectorMap({
            map: 'world_mill_en',
            series: {
                regions: [{
                    values: gdpData,
                    scale: ['#000', '#000'],
                    normalizeFunction: 'polynomial'
                }]
            },
            backgroundColor: '#eef3f7',
            onLabelShow: function(e, el, code){
                el.html(el.html()+' (GDP - '+gdpData[code]+')');
            }
        });
    });

</script>

</body>
</html>
