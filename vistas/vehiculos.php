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
                          <h1 class="box-title">Vehículos &nbsp;&nbsp; <button class="btn btn-success" id="btnAgregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Matricula</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Matricula</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Estado</th>
                            </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Marca:</label>
                            <input type="hidden" name="idvehiculo" id="idvehiculo">
                            <input type="text" class="form-control" name="marca" id="marca" maxlength="100" placeholder="Marca" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Modelo:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="100" placeholder="Modelo" required>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Matricula:</label>
                            <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Matricula" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Matriculación:</label>
                            <input type="date" class="form-control" name="fecha_matricula" id="fecha_matricula" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Compra:</label>
                            <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Extras:</label>
                            <textarea class="form-control" name="extras" id="extras" maxlength="255" rows="4" cols="50" placeholder="Extras"></textarea>
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
<script type="text/javascript" src="scripts/vehiculos.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>