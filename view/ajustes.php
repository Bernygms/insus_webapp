<?php include '../templates/header.php'; ?>
        <div class="content-wrapper">
          <div class="row w-100">
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-transparent text-left p-5 text-center">
                <img src="../images/faces/face2.jpg" class="lock-profile-img col-md-4" alt="img">
                <form class="pt-5">
                  <div class="form-group">
                    <h3><?php echo  $_SESSION['nombre_usu']. ' ' .$_SESSION['apellidos_usu'];?></h3>
                    <spanfor="examplePassword1"><?php echo $_SESSION['correo_usu'];?></span>
                  </div>
                  <div class="mt-5">
                    <a class="btn btn-block btn-success btn-lg font-weight-medium" href="#">Actualizar</a>
                  </div>
                  <div class="mt-3 text-center">
                    <a href="#" class="auth-link text-white">Sign in using a different account</a>
                  </div>
                </form>
              </div>
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
<?php include '../templates/footer.php'; ?>