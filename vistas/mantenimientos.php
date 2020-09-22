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
                          <h1 class="box-title">Mantenimientos &nbsp;&nbsp; 
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
                          <th>Nombre</th>
                          <th>Vehículo</th>
                          <th>Categoría</th>
                          <th>Proveedor</th>
                          <th>Total</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>fecha</th>
                          <th>Nombre</th>
                          <th>Vehículo</th>
                          <th>Categoría</th>
                          <th>Proveedor</th>
                          <th>Total</th>
                          </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idmantenimiento" id="idmantenimiento">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="200" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría:</label>
                            <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Vehiculo:</label>
                            <select id="idvehiculo" name="idvehiculo" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="4" rows="4" placeholder="Descripción"></textarea>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Proveedor:</label>
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Kilómetros:</label>
                            <input type="number" class="form-control" name="kms" id="kms" placeholder="Kilómetros Vehículo">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Precio:</label>
                            <input type="text" class="form-control" name="precio" id="precio" onchange="calcularTotal();">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Impuesto (%):</label>
                            <input type="text" class="form-control" name="impuesto" id="impuesto" onchange="calcularTotal();">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Total:</label>
                            <input type="text" class="form-control" name="total" id="total">
                            <input type="hidden" name="total_mantenimiento" id="total_mantenimiento">
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
<script type="text/javascript" src="scripts/mantenimientos.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>