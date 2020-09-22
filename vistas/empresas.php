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

    if($_SESSION['rol']==1)
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
                          <h1 class="box-title">Empresa &nbsp;&nbsp; <button class="btn btn-success" id="btnAgregar" onclick="mostrarForm(true)" ><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Documento</th>
                          <th>Número Documento</th>
                          <th>Teléfono</th>
                          <th>Localidad</th>
                          <th>Email</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Documento</th>
                          <th>Número Documento</th>
                          <th>Teléfono</th>
                          <th>Localidad</th>                          
                          <th>Email</th>
                          <th>Estado</th>
                      </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idempresa" id="idempresa">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre de Empresa" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Documento:</label>
                            <select id="documento" name="documento" class="form-control selectpicker" required>
                              <option value="DNI">DNI</option>
                              <option value="NIF">NIF</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Número Documento:</label>
                            <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Número de Documento" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="255" placeholder="Dirección">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Código Postal:</label>
                            <input type="text" class="form-control" name="cp" id="cp" maxlength="5" placeholder="Código Postal">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localidad:</label>
                            <input type="text" class="form-control" name="localidad" id="localidad" maxlength="75" placeholder="Localidad">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Provincia:</label>
                            <input type="text" class="form-control" name="provincia" id="provincia" maxlength="75" placeholder="Provincia">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono:</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="15" placeholder="Teléfono">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Móvil:</label>
                            <input type="tel" class="form-control" name="movil" id="movil" maxlength="15" placeholder="Móvil">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Web:</label>
                            <input type="text" class="form-control" name="web" id="web" maxlength="150" placeholder="Web">
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

<script type="text/javascript" src="scripts/empresas.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>