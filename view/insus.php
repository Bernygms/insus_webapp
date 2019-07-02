<?php include '../templates/header.php'; ?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Inicio</p>
                    <p class="text-primary mb-0 hover-cursor" id="name_user"></p>
                    <p class="text-primary mb-0 hover-cursor" id="nombre_estado"></p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-arrow-left-bold text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-arrow-right-bold text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div id="div_est" class="card-body">
                  <p id="titulo_est" class="card-title">Cargando ...</p>
                  <div id="estados" class="table-responsive"></div>
                </div>
                <div id="div_raci" class="card-body">
                  <p id="titulo_raci" class="card-title">Cargando ...</p>
                  <div id="contenedor" class="table-responsive"></div>
                  <br>
                </div>
                
                <!--<div id="" class="card-body">
                  <p id="titulo_raci" class="card-title">Cargando ...</p>
                  <div id="" class="table-responsive">
                    <table id="table_raci" class="table table-hover mytable">
                      <thead>
                        <tr>
                          <th>Entidad</th>
                          <th>Cv.INSUS</th>
                          <th>Cv.INEGI</th>
                          <th>Modalidad</th>
                          <th>Poblado</th>
                          <th>Municipio</th>
                          <th>Superficie</th>
                          <th>Municipio</th>
                          <th>Contrataciòn</th>
                          <th>Lotes</th>
                          <th>Contratados</th>
                          <th>Pendientes</th>
                          <th></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>-->

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
<?php include '../templates/footer.php'; ?>