<?php 
if(strlen(session_id()) < 1)
{
  session_start();
}
//print_r($_SESSION);

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GesTransport - Gestíon de Facturación para Transportistas | TFG </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">



<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>GT</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>GesTransport</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/1584297456.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=$_SESSION['nombre']?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/1584297456.jpg" class="img-circle" alt="User Image">
                    <p>
                     Trabajo Final de Grado
                      <small>www.unir.es</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <button id="salir" name="salir" class="btn btn-default btn-flat">Cerrar</button>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="home.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>
<!--            <li>
              <a href="desk.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>-->
<?php
/*  if($_SESSION['administrador']==1 || $_SESSION['gerente']==1)
  {*/
?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i>
                <span>Gestión Facturación</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="servicios.php"><i class="fa fa-circle-o"></i> Servicios</a></li>
                <li><a href="facturas.php"><i class="fa fa-circle-o"></i> Facturas</a></li>
              </ul>
            </li>

<?php
 // }
?>          
 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-car"></i>
                <span>Gestíon Vehículos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="vehiculos.php"><i class="fa fa-circle-o"></i> Vehículos</a></li>
                <li><a href="repostajes.php"><i class="fa fa-circle-o"></i> Repostajes</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Gestíon Mantenimientos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="mantenimientos.php"><i class="fa fa-circle-o"></i> Mantenimientos</a></li>
                <li><a href="proveedores.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="categorias.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
<!--                <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consultas Fecha</a></li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Gestión Aplicación</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="empresas.php"><i class="fa fa-circle-o"></i> Datos Empresa</a></li>
                <li><a href="usuarios.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Ayuda.</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
<!--                <li><a href="soporte.php"><i class="fa fa-circle-o"></i> Soporte Técnico</a></li> -->
              </ul>
            </li>


           </ul>
        </section>
        <!-- /.sidebar -->
      </aside>