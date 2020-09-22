    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?=date('Y')?> <a href="#">GesTransport</a>.</strong> Derechos reservados.
    </footer>    
    <!-- jQuery 2.1.4 -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/js/app.min.js"></script>

    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <script src="../public/datatables/pdfmake.min.js"></script>
    <script src="../public/datatables/vfs_fonts.js"></script>

    <script src="../public/js/bootbox.min.js"></script>
    <script src="../public/js/bootbox.locales.min.js"></script>
    
    <script src="../public/js/bootstrap-select.min.js"></script>
    
    <script>
        
    $("#salir").on("click",function(){
        salir();
    });


        function salir()
        {
            $.post("../ajax/usuarios.php?op=salir",
                function(e)
                {
                    if(e) location.href = "../index.php ";
                    else console.log(e.responseText);
                }
            );

        }

    </script>

  </body>
</html>