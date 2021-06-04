<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
            include "header.php";
            ?>   <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
      
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                  <i class="fas fa-align-left"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fas fa-align-justify"></i>
                </button>
      
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link btn " id="btnCerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                    </li>
                  </ul>
                </div>
            </nav>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
            
                        </div>
                    </div>
                </div>
            <?php
                  include "footer.php";
        }
       
?>
       