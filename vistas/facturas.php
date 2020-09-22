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
                          <h1 class="box-title">Facturas &nbsp;&nbsp; 
                            <button class="btn btn-success" id="btnAgregar" onclick="mostrarForm(true)">
                              <i class="fa fa-plus-circle"></i> Agregar</button>
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
                          <th>Fecha</th>
                          <th>Tipo</th>
                          <th>Serie</th>
                          <th>Número</th>
                          <th>Cliente</th>
                          <th>Total</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Tipo</th>
                          <th>Serie</th>
                          <th>Número</th>
                          <th>Cliente</th>
                          <th>Total</th>
                          <th>Estado</th>
                      </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Cliente: (*)</label>
                            <input type="hidden" name="idfactura" id="idfactura">
                            <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required="true">
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha: (*)</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required="true">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Tipo Factura: (*)</label>
                            <select id="tipo_factura" name="tipo_factura" class="form-control selectpicker" required="true">
                              <option value="Proforma">Proforma</option>
                              <option value="Factura">Factura</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie" maxlength="7">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Número Factura:</label>
                            <input type="text" class="form-control" name="numero_factura" id="numero_factura" placeholder="Número" maxlength="10" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Impuesto (%):</label>
                            <input type="text" class="form-control" name="impuesto" id="impuesto" required="true">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Retención IRPF (%):</label>
                            <input type="text" class="form-control" name="retencion" id="retencion" required="true">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnAgregarArt">
                                <span class="fa fa-plus"></span> Agregar Servicios
                              </button>
                            
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color: #a9d0f5">
                                <th>Opciones</th>
                                <th>Servicio</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Descuento (%)</th>
                                <th>Subtotal</th>
                              </thead>
                              <tbody></tbody>
                              <tfoot>
                                <th><h4><strong>Total: </strong></h4></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                  <h4 id="total">0.00 €</h4>
                                  <input type="hidden" name="total_factura" id="total_factura">
                                </th>
                              </tfoot>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Seleccione un Servicio</h4>
      </div>
      <div class="modal-body">
       <table id="tblServicios" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Opciones</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Descripción</th>
          </thead>
          <tbody></tbody>
          <tfoot>
            <th>Opciones</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Descripción</th>
          </tfoot>
        </table>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
      </div>
    </div>
  </div>
</div>




<?php
}
else 
{
  require "noacceso.php";
}

require "footer.php";
?>

<script type="text/javascript" src="scripts/facturas.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>