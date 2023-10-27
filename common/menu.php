<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <a href="<?= $root;?>" class="brand-link">
    <img src="<?= $root;?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">MSJ</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $root;?>assets/user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block" data-toggle="modal" data-target="#modal_usuario" data-id="<?=$id?>"><?=$nombre?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">USUARIOS</li>
        <li class="nav-item">
          <a href="<?=$root?>users.php" class="nav-link">
            <i class="nav-icon fas fa-address-card"></i>
            <p>Usuarios del sistema</p>
          </a>
        </li>


        <!-- <li class="nav-header">USUARIOS</li>
        <li class="nav-item">
          <a href="<?= $root;?>users" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Lista de Usuarios
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= $root;?>users/add.php" class="nav-link">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>
              Agregar usuario
            </p>
          </a>
        </li> -->


        <li class="nav-header">CALENDARIO</li>
        <li class="nav-item">
          <a href="<?= $root;?>mensajes/" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Ver Mensajes Programados
            </p>
          </a>
        </li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>

        

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <div class="sidebar-custom">
    <a href="#" class="btn btn-danger pos-right" onclick="logout('<?=$root?>')">
      <i class="fas fa-sign-out-alt"></i> SALIR
    </a>
    <br><br>
  </div>
  
</aside>