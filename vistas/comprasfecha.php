<?php

//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION['nombre']))
{
  header('location: login.php');
}
else{
require "header.php";

  if($_SESSION['administrador']==1 || $_SESSION['consultac']==1)
  {

?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Consulta de Compras por fecha</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="fecha_inicio">Fecha Inicio: </label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?= date("Y-m-d"); ?>">
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="fecha_fin">Fecha Fin: </label>
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?= date("Y-m-d"); ?>">
                      </div>

                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Fecha</th>
                          <th>usuario</th>
                          <th>Proveedor</th>
                          <th>Comprobante</th>
                          <th>Número Comprobante</th>
                          <th>Total Compra</th>
                          <th>Impuesto</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Fecha</th>
                          <th>usuario</th>
                          <th>Proveedor</th>
                          <th>Comprobante</th>
                          <th>Número Comprobante</th>
                          <th>Total Compra</th>
                          <th>Impuesto</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div>

                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else 
{
  require "noacceso.php";
}

require "footer.php";
?>
<script type="text/javascript" src="scripts/comprasfecha.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>