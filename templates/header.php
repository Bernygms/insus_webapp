<?php
session_start();
if(!isset($_SESSION["rol_usu"]))  
 {
  header("Location: login.php");
 }else{
  
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
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>-->
 
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <!-- personalizada:css -->
  <link rel="stylesheet" href="../css/estilos.css">
  <!-- personalizada:css -->
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
    <!-- partial:partials/_navbar.html -->
    <div id="id_session">
      <input type="hidden" id="id_usu" name="id_usu" value="<?php echo $_SESSION['id_usu'];?>">
      <input type="hidden" id="nombre_usu" name="nombre_usu" value="<?php echo $_SESSION['nombre_usu'];?>">
      <input type="hidden" id="apellidos_usu" name="apellidos_usu" value="<?php echo $_SESSION['apellidos_usu'];?>">
      <input type="hidden" id="usuario_usu" name="usuario_usu" value="<?php echo $_SESSION['usuario_usu'];?>"> 
      <input type="hidden" id="correo_usu" name="correo_usu" value="<?php echo $_SESSION['correo_usu'];?>"> 
      <input type="hidden" id="estado_usu" name="estado_usu" value="<?php echo $_SESSION['estado_usu'];?>"> 
      <input type="hidden" id="rol_usu" name="rol_usu" value="<?php echo $_SESSION['rol_usu'];?>"> 
      <input type="hidden" id="pk_id_est" name="pk_id_est" value="<?php echo $_SESSION['pk_id_est'];?>"> 
    </div>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="insus.php"><img src="../images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="insus.php"><img src="../images/logo-mini.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <div id="search_est"></div>
              <div id="search_raci"></div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Mensajes</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../images/faces/avatar.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Berns Gms
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    La reunión se cancela
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../images/faces/avatar.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Omar Garcia
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Lanzamiento de nuevos productos
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../images/faces/avatar.png" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Juan Cabanzo 
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Próxima reunión de la junta directiva
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Error de aplicación</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Ahora mismo
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Ajustes</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Mensaje privado
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Registro de nuevo usuario</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Hace 2 días
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../images/faces/avatar.png" alt="profile"/>
              <span class="nav-profile-name"><?php echo $_SESSION['nombre_usu']. " ".$_SESSION['apellidos_usu']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="ajustes.php">
                <i class="mdi mdi-settings text-primary"></i>
                Ajustes
              </a>
              <a class="dropdown-item" href="exit.php">
                <i class="mdi mdi-logout text-primary" ></i>
                Cierre de sesión
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="insus.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Inicio</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Resumen">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Resumen</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#CD">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Concentrado CD 2019</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Reporte">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Resporte por Entiedad</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">