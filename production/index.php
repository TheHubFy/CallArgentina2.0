<?php 
  include ('asset/php/library.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Call Argentina | IOMA</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <!--<link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">-->
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">    
    
    <!-- Custom Style -->
    <link href="asset/css/index.css" rel="stylesheet">
    
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="formlogin" name="formlogin" method="POST" action="asset/api/clase.php?login">
              <h1>Sistema Interno</h1>
              <div>
                <input type="text" name="user" class="form-control" placeholder="Usuario" />
              </div>
              <div>
                <input type="password" name="pass" class="form-control" placeholder="Password" />
              </div>
              <div>
                <a class="btn btn-default submit btn-lg" href="javascript: loginCkek();" >Ingresar</a>
              </div>
              <div id="messenger"><?php 
                                      if(status('logout')){echo '<p>¡Has cerrado sesión con éxito!</p>';}
                                      if(status('denied')){echo '<p>¡Acceso denegado!, inicia sesión por favor.</p>';}
                                      if(status('timeout')){echo '<p>¡Sesión Caducada!, volvé a iniciar sesión.</p>';}
                                  ?>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Call Argentina</h1>
                  <p>© <?php echo getDateNow(); ?> Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <!-- Formulario AJAX -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>    
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="asset/js/moment/moment.min.js"></script>
    <script src="asset/js/datepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- Custoum -->    
    <script src="asset/js/library.js"></script>
    
     
  </body>
</html>