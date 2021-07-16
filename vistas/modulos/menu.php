 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
      <img src="vistas/img/plantilla/Logo_euroLatina.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background: white;">
      <span class="brand-text font-weight-light">EUROLATINA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="inicio" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Inicio
                </p>
                </a>
            </li>
            <?php
            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){
            ?>
            <li class="nav-item">
                <a href="pedidos" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Pedidos
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="problemas" class="nav-link">
                <i class="nav-icon fas fa-ban"></i>
                <p>
                  Problemas
                </p>
                </a>
            </li>
            <?php } ?>
            <?php
            if($_SESSION["perfil"] == "Especial"){
            ?>
            <li class="nav-item">
                <a href="asignar" class="nav-link">
                <i class="nav-icon fas fa-project-diagram"></i>
                <p>
                  Asignar pedido a maquina
                </p>
                </a>
            </li>
            <?php } ?>
            <?php
            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){
            ?>
            <li class="nav-item" hidden>
                <a href="modelo" class="nav-link">
                <i class="nav-icon fas fa-socks"></i>
                <p>
                  Modelo
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="lineas" class="nav-link">
                <i class="nav-icon fas fa-grip-lines"></i>
                <p>
                  Líneas
                </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="maquinas" class="nav-link">
                <i class="nav-icon fas fa-dumpster"></i>
                <p>
                    Maquinas
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="usuarios" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Usuarios
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="clientes" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Clientes
                </p>
                </a>
            </li>
            <?php } 
              if($_SESSION["perfil"] == "Especial"){

            ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reportes" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                  <p>Modelos defectuosos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reportesUsuario" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Empleado</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reportePlanchado" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Planchado</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reporteMaquinas" class="nav-link">
                  <i class="nav-icon fas fa-dumpster"></i>
                  <p>Maquinas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reporteErrores" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Problemas</p>
                </a>
              </li>
             
            </ul>
          </li>
          <?php } if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){ ?>
          <li class="nav-item">
                <a href="colores" class="nav-link">
                <i class="nav-icon fas fa-palette"></i>
                <p>
                  Colores
                </p>
                </a>
          </li>

          <li class="nav-item">
                <a href="piezas" class="nav-link">
                <i class="nav-icon fas fa-socks"></i>
                <p>
                  Modelo
                </p>
                </a>
          </li>

          <?php } ?>
 
          <?php 
              if($_SESSION["perfil"] == "Especial"){

            ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                CRM
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reportes" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                  <p>Presupuesto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reportesUsuario" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Empleado</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reporteErrores" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Configuración CRM</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reportes" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                  <p>Porcentaje de éxito</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reportesUsuario" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Tipo de Acción</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reporteErrores" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Unidad</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reporteErrores" class="nav-link">
                  <i class="nav-icon fas fa-ban"></i>
                  <p>Estado</p>
                </a>
              </li>
             
            </ul>
              </li>
              
            </ul>
          </li>
          <?php } ?>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
