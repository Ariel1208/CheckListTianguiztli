    
    
        </div>
    </div>
   <script src="../lib/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap4/popper.min.js"></script>
    <script src="../lib/bootstrap4/bootstrap.min.js"></script>
    <script src="../lib/sweetalert.min.js"></script>
    <script src="../lib/datatable/jquery.dataTables.min.js"></script>
    <script src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../JS/app.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        $('#btnCerrarSesion').click(function(){
            cerrarSesion();
        });
    });
        

        
    </script>
    </body>
</html>