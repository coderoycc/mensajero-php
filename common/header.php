<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user" style="font-size: 20px"></i>
        <span class="badge badge-success navbar-badge" style="font-size:0.2rem;   padding:4px;border-radius:50%;">·</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?=$nombre?></span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_usuario" data-id="<?=$id?>">
          <i class="fas fa-key"></i> Cambiar contraseña
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer" onclick="logout('<?=$root?>')">
          <i class="fas fa-sign-out-alt text-danger"></i> Cerrar sesión
        </a>
      </div>
    </li>
       
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    
  </ul>
</nav>
<!-- /.navbar -->

<!-- MODAL USER -->
<div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_m_u"><?=$nombre?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 align="center">¿Cambiar contraseña?</h5>
        <div class="dropdown-divider"></div>
        <form>
          <input type="hidden" value="" id="id_user">
          <div class="form-group">
            <label for="pass" class="col-form-label">Contraseña actual:</label>
            <div class="input-group mb-3">
              <input type="password" class="form-control" aria-label="Recipient's username" aria-describedby="pass-addon" id="pass">
              <div class="input-group-append">
                <span class="input-group-text" id="pass-addon" data-visible="false" data-obj="pass" style="cursor:pointer;" onclick="showPass(this)"><i class="fas fa-eye"></i></span>
              </div>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <div class="form-group">
            <label for="n_pass" class="col-form-label">Nueva Contraseña:</label>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="n_pass" aria-describedby="n_pass-addon">
              <div class="input-group-append">
                <span class="input-group-text" id="n_pass-addon" data-visible="false" data-obj="n_pass" style="cursor:pointer;" onclick="showPass(this)"><i class="fas fa-eye"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-top:-5px;">
            <label for="pass_repeat" class="col-form-label">Repita su nueva contraseña:</label>
            <input type="password" class="form-control" id="pass_repeat">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-primary" id="btn_cambiar" data-dismiss="modal" onclick="cambiarPass('<?=$root?>')">CAMBIAR</button>
      </div>
    </div>
  </div>
</div>

