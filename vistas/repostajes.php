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

    if($_SESSION['rol']==1 || $_SESSION['rol']==2)
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
                          <h1 class="box-title">Repostajes &nbsp;&nbsp; 
                            <button class="btn btn-success" id="btnAgregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                          </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>fecha</th>
                          <th>Vehículo</th>
                          <th>Conductor</th>
                          <th>Litros</th>
                          <th>Total</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>fecha</th>
                          <th>Vehículo</th>
                          <th>Conductor</th>
                          <th>Litros</th>
                          <th>Total</th>
                          </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Vehiculo:</label>
                            <input type="hidden" name="idrepostaje" id="idrepostaje">
                            <select id="idvehiculo" name="idvehiculo" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Litros:</label>
                            <input type="text" class="form-control" name="litros" id="litros" maxlength="200" placeholder="Litros" required>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Kilómetros:</label>
                            <input type="number" class="form-control" name="kms" id="kms" placeholder="Kilómetros Vehículo">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Importe:</label>
                            <input type="text" class="form-control" name="total_repostaje" id="total_repostaje">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Conductor:</label>
                            <input type="text" class="form-control" name="conductor" id="conductor">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button  class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i>  Guardar
                            </button>
                            <button  class="btn btn-danger" type="button" id="btnCancelar" onclick="cancelarForm()">
                              <i class="fa fa-arrow-circle-left"></i>  Cancelar
                            </button>
                          </div>

                          
                        </form>
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
<script type="text/javascript" src="scripts/repostajes.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>