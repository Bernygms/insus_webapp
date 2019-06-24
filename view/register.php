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
              <h4>¿Es nuevo aquí?</h4>
              <h6 class="font-weight-light">Registrarse es fácil. Sólo se necesitan unos pocos pasos.</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" placeholder="Correo">
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" id="country">
                    <option>Country</option>
                    <option>United States of America</option>
                    <option>United Kingdom</option>
                    <option>India</option>
                    <option>Germany</option>
                    <option>Argentina</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Contraseña">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Acepto todos los Términos y Condiciones
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="insus.php">REGISTRARSE</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  ¿Ya tienes una cuenta? <a href="login.php" class="text-primary">Login</a>
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
  <!--JQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!--JQuery -->
  <!-- framework toastr:js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- framework toastr:js -->
  <script>
    window.onload = function(){
      $("#contenedor_init_load").fadeOut();
      $('#contenedor_init_load').delay(0).fadeOut('slow');
    };
    toastr.success('Welcome to Register.','INSUS');
  </script>
</body>

</html>
