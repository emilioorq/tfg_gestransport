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
                          <h1 class="box-title">Panel Usuarios &nbsp;&nbsp; <button class="btn btn-success" id="btnAgregar" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
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
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Últ. Acceso</th>
                          <th>Estado</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Últ. Acceso</th>
                          <th>Estado</th>
                      </tfoot>
                      </table>
                    </div>

                    <div class="panel-body table-responsive" id="formularioregistros">
                          <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Nombre:</label>
                              <input type="hidden" name="idusuario" id="idusuario">
                              <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del Usuario" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Email:</label>
                              <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Rol:</label>
                              <select id="rol" name="rol" class="form-control selectpicker" required>
                                <option value="1">Administrador</option>
                                <option value="2">Contabilidad</option>
                              </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label>Contraseña:</label>
                              <input type="password" class="form-control" name="password" id="password" maxlength="75" placeholder="Password" required>
                              <input type="hidden" name="claveactual" id="claveactual">
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

<script type="text/javascript" src="scripts/usuarios.js"></script>
<?php 
}
//vaciar el buffer.
ob_end_flush();
?>