
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="#" target="_blank">INSUS</a>. Todos los derechos reservados.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!--JQuery and bootstrap 4 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  JQuery and bootstrap 4 -->
  <!-- Plugin js for this page-->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/dashboard.js"></script>
  <script src="../js/data-table.js"></script>
  <script src="../js/jquery.dataTables.js"></script>
  <!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>-->
  <script src="../js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->

  <!-- framework toastr:js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- framework toastr:js -->
  <!--acceso js-->
  <script type="text/javascript" src="../libs/toastr.js"></script>
  <script type="text/javascript" src="../libs/ajax.js"></script>
  <script type="text/javascript" src="../libs/insus_app.js"></script>
  <script type="text/javascript" src="../libs/init.js"></script>
  <!--acceso js-->
  <script>
    window.onload = function(){
      $("#contenedor_init_load").fadeOut();
      $('#contenedor_init_load').delay(0).fadeOut('slow');
    };
  </script>
  <!--Inicia Modal : myModalAddAcciones -->

<!-- Modal -->
<div class="modal fade" id="myModalAddAcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="card ">
          <div class="card-header text-center ">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Autorización</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">En Proceso</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">VoBo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Cierre</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
          <!--body del modal-->
            <form id="form_update_propuesta" name="form_update_propuesta">
            <div class="modal-body">
             <div class="row">
              <div id="mesage_edit" class="form-group col-md-12">
              </div>
              <div class="form-group col-md-4">
                <label for="id">No. Propuesta </label>
                <input id="op" name="op" type="hidden" class="form-control" value="editar" />
                <input id="app" name="app" type="hidden" class="form-control" value="<?php echo $_SESSION['nombre_app'] ?>"/>
                <input id="anno" name="anno" type="hidden"/>
                <input id="id_estado" name="id_estado" type="hidden" >
                <input id="id_file" name="id_file" type="hidden"/>
                <input id="ofic_porp_nombre" name="ofic_porp_nombre" type="hidden"/>
                <input id="anexo6_nombre" name="anexo6_nombre" type="hidden"/>
                <input id="anexo7_nombre" name="anexo7_nombre" type="hidden"/>
                <input id="lis_de_bene_nombre" name="lis_de_bene_nombre" type="hidden"/>
                <input id="num_prop" name="num_prop" type="text" class="form-control" placeholder="01-001" maxlength="6"  />
              </div>
              <div class="form-group col-md-4">
                <label for="id">Oficio de Propuesta</label>
                <input type="file" class="form-control-file" id="ofic_porp" name="ofic_porp" >
              </div>   
              <div class="form-group col-md-4">
                <label for="id">Anexo 6</label>
                <input type="file" class="form-control-file" id="anexo6" name="anexo6" >
              </div> 
              <div class="form-group col-md-4">
                <label for="id">Anexo 7</label>
                <input type="file" class="form-control-file" id="anexo7" name="anexo7">
              </div> 
              <div class="form-group col-md-4">
                <label for="id">Listado de Beneficiarios</label>
                <input type="file" class="form-control-file" id="lis_de_bene" name="lis_de_bene">
              </div>        
            </div>
            <!--footer modal-->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" onclick="editOAAL()" class="btn btn-primary">Guardar propuesta</button>
            </div>
            <div id="ajaxloader" style="display:none"><img class="mx-auto mt-30 mb-30 d-block" src="../images/pre-loader/loader-02.svg" alt=""></div>
          </div>
          </form>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <!--Termina Modal : myModalAddAcciones -->

  <!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>