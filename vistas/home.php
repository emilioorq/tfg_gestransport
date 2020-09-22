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

      <h2>Bienvenido <?= $_SESSION['nombre'] ?></h2>

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

<?php 
}
//vaciar el buffer.
ob_end_flush();
?>