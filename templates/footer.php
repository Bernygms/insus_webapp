
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
   <!-- Large modal start files  add files-->
  <div id="myModalAddAcciones" class="modal fade bd-prah-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <!--header modal-->
      
      <div class="modal-header modal-header-info">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregando acciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card col-md-12">
        <div class="card-header text-center ">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a id="nav1" class="nav-link">Datos del poblado</a>
            </li>
            <li class="nav-item">
              <a id="nav2" class="nav-link">Acciones y programa</a>
            </li>
            <li class="nav-item">
              <a id="nav3" class="nav-link">Agregar beneficiarios</a>
            </li>
            <li class="nav-item">
              <a id="nav4" class="nav-link">Terminar</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
        <!--body del modal-->
          <div id="div_datos_poblado">
            <div class="modal-body">
             <div class="row">
              <div class="form-group col-md-3">
                <label for="id">Identificador:</label>
                <input id="id_raci" name="id_raci" type="text" class="form-control border border-primary" disabled/>
              </div>
              <div class="form-group col-md-3">
                <label for="id">Entidad:</label>
                <input id="entidad_raci" name="entidad_raci" type="text" class="form-control border border-primary" disabled/>
              </div>   
              <div class="form-group col-md-3">
                <label for="id">Clave INSUS:</label>
                <input id="clave_insus_raci" name="clave_insus_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Clave INEGI:</label>
                <input id="clave_inegi_raci" name="clave_inegi_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Modalidad:</label>
                <input id="modalidad_raci" name="modalidad_raci" type="text" class="form-control border border-primary" disabled/>
              </div>  
              <div class="form-group col-md-3">
                <label for="id">Poblado:</label>
                <input id="nombre_de_pob_raci" name="nombre_de_pob_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Municipio:</label>
                <input id="municipio_raci" name="municipio_raci" type="text" class="form-control border border-primary" disabled/>
              </div>     
              <div class="form-group col-md-3">
                <label for="id">Superficie:</label>
                <input id="superficie_de_pob_raci" name="superficie_de_pob_raci" type="text" class="form-control border border-primary" disabled/>
              </div>  
              <div class="form-group col-md-3">
                <label for="id">Programa Municipio:</label>
                <input id="municipio_pro_raci" name="municipio_pro_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Fecha de Contratacion:</label>
                <input id="fecha_ini_con_raci" name="fecha_ini_con_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Universo de lotes:</label>
                <input id="universo_de_lot_raci" name="universo_de_lot_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
              <div class="form-group col-md-3">
                <label for="id">Contratados:</label>
                <input id="total_con_raci" name="total_con_raci" type="text" class="form-control border border-primary" disabled/>
              </div> 
            </div>
            <!--footer modal-->
            <div class="modal-footer">
              <button id="btn_next_1" type="button" class="btn btn-primary">Continuar</button>
            </div>
          </div>
          </div>
        <!--Datos: agregar accion y programa-->
        <div id="div_accion_y_programa">
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-2">
                <label for="id">Programa:</label>
                <select id="pk_id_pro" name="pk_id_pro" class="form-control border border-primary">
                      <option value="">Secciona un programa</option>
                      <option value="1">REGLA 1</option>
                      <option value="2">REGLA 2</option>
                      <option value="3">REGLA 3</option>
                      <option value="4">PMU</option>
                      <option value="5">PRAH</option>
                      <option value="6">PASPRAH</option>
                      <option value="7">OTROS</option>
                    </select>
              </div>
              <div class="form-group col-md-2">
                <label for="id">Accion:</label>
                <input id="accion_con" name="accion_con" type="text" class="form-control border border-primary" />
              </div>
              <div class="form-group col-md-2">
                <label for="id">Pago Beneficiario:</label>
                <input id="pago_ben_con" name="pago_ben_con" type="text" class="form-control border border-primary" />
              </div>   
              <div class="form-group col-md-2">
                <label for="id">Apoyo INSUS:</label>
                <input id="apoyo_insus_con" name="apoyo_insus_con" type="text" class="form-control border border-primary" />
              </div> 
              <div class="form-group col-md-2">
                <label for="id">Subsidio:</label>
                <input id="subsidio_con" name="subsidio_con" type="text" class="form-control border border-primary" />
              </div>       
            </div>
          <!--footer modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger text-left"></button>
            <button type="button" id="btn_before_2" class="btn btn-light">Regresar</button>
            <button type="button" id="btn_next_2" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        </div>
        <!--Datos: agregar accion y programa-->
        <div id="div_beneficiarios">
          <div class="modal-body">
           <div class="row">
            <div class="form-group col-md-4">
              <label for="id">Fecha de Contratacion:</label>
              <input id="fecha_ini_con_raci" name="fecha_ini_con_raci" type="text" class="form-control border border-primary" />
            </div> 
            <div class="form-group col-md-4">
              <label for="id">Universo de lotes:</label>
              <input id="universo_de_lot_raci" name="universo_de_lot_raci" type="text" class="form-control border border-primary" />
            </div> 
            <div class="form-group col-md-4">
              <label for="id">Contratados:</label>
              <input id="total_con_raci" name="total_con_raci" type="text" class="form-control border border-primary" />
            </div> 
          </div>
          <!--footer modal-->
          <div class="modal-footer">
            <button type="button" id="" class="btn btn-light">Regresar</button>
            <button type="button" id="" class="btn btn-primary">Continuar</button>
          </div>
        </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
  <!--Termina Modal : myModalAddAcciones -->
</body>

</html>