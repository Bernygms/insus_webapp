<?php include '../templates/header.php'; ?>
        <div class="content-wrapper">
          <!--<div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    
                  </div>
                  <div class="d-flex mr-top-10">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Inicio</p>
                    <p class="text-primary mb-0 hover-cursor" id="name_user"></p>
                    <p class="text-primary mb-0 hover-cursor" id="nombre_estado"></p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" id="btn_beaforPage" class="btn btn-primary bg-white btn-icon mr-3 d-none d-md-block">
                    <i class="mdi mdi-arrow-left-bold text-muted"></i>
                  </button>
                  <button type="button" id="btn_nextPage" class="btn btn-primary bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-arrow-right-bold text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>-->
          <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                  <div id="div_est" class="card-body">
                    <p id="titulo_est" class="card-title">Cargando ... estado/s</p>
                    <div id="buscador_estados" class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="search">
                          <i class="mdi mdi-magnify"></i>
                        </span>
                      </div>
                      <div id="search_est">
                      </div>
                    </div>
                    <div id="tab_est" class="table-responsive">
                    </div>
                </div>
                
                <div id="div_raci" class="card-body">
                  <p id="titulo_raci" class="card-title">Cargando ... contenido de los poblados.</p>
                  <div id="tab_raci" class="table-responsive"></div>
                  <br>
                </div>
                <div id="div_pro_benef" class="card-body">
                  <div class="text-center"> 
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Acciones y Benerficiarios
                      </label>
                      <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Acciones
                      </label>
                      <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option3" autocomplete="off"> Otros Rectificaciones
                      </label>
                    </div>
                  </div>
                  <p id="titulo_prog_benef" class="card-title">Cargando ... programas y beneficiarios. </p>
                  <div id="tab_progra_benef" class="table-responsive"></div>
                  <br>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
<?php include '../templates/footer.php'; ?>