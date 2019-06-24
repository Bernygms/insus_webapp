<?php
session_start();
if(isset($_SESSION["rol_usu"])){
    header('location: insus.php');
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>INSUS - Programa para Regularizar Asentamientos Humanos - Programa de Mejoramiento Urbano.</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- personalizada:css -->
  <link rel="stylesheet" href="../css/estilos.css">
  <!-- endinject -->
    <!-- framework toastr:css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- framework toastr:css -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <!--loading init-->
  <div id="contenedor_init_load">
    <div id="init_load"></div>
  </div>
  <!--loading end-->
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../images/logo.png" alt="logo">
              </div>
              <h4>Hola! vamos a empezar</h4>
              <h6 class="font-weight-light">Inicie sesión para continuar.</h6>
              <form class="pt-3" id="fromlogin" name="fromlogin">
                <input type="hidden" class="form-control form-control-lg" id="op" name="op" value="login">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="correo_usu" name="correo_usu" placeholder="Nombre de usuario o correo." required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password_usu" name="password_usu" placeholder="Contraseña" required>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"  id="acceso">Continuar</a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Mantener mi nombre de usuario activo.
                    </label>
                  </div>
                  <a class="auth-link text-black">¿Olvidó su contraseña?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  ¿No tiene una cuenta? <a  class="text-primary">Crear</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <!-- endinject -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!--JQuery -->
    <!-- framework toastr:js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- framework toastr:js -->
  <!--acceso js-->
  <script type="text/javascript" src="../libs/toastr.js"></script>
  <script type="text/javascript" src="../libs/ajax.js"></script>
  <script type="text/javascript" src="../libs/acceso.js"></script>
  <script type="text/javascript" src="../libs/login.js"></script>
  <!--acceso js-->
  <script>
    window.onload = function(){
      $("#contenedor_init_load").fadeOut();
      $('#contenedor_init_load').delay(0).fadeOut('slow');

    };
  </script>
  
</body>

</html>
