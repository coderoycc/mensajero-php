<?php
session_start();
$root = './';
if(!isset($_SESSION['id'])){
  header('Location: ./');
}
$nombre = $_SESSION['nombre'];
$id = $_SESSION['id'];
$rol = $_SESSION['rol'];

include('./conexion.php');
$sql = "SELECT idUsuario, nombres, rol, celular FROM tblUsuario;";
$stmt = sqlsrv_query($con, $sql);
if($stmt === false) {
  header('Location: ./views/error.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>USUARIOS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include('./views/modalEliminarUsuario.php');?>
  <?php include('./views/modalEditarUsuario.php');?>
  <?php include('./views/modalResetearPass.php');?>
  <?php include('./views/modalNuevoUsuario.php');?>

  <input type="hidden" id="idUsuario">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include_once('common/header.php'); ?>

    <!-- Main Sidebar Container -->
    <?php include_once('common/menu.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Usuarios del sistema </h1>
            </div>
            <?php if($rol == 'ADMIN'):?>
            <div class="col-sm-6">
              <button class="btn btn-success float-right" type="button" data-toggle="modal" data-target="#modal-nuevo-usuario"><i class="fas fa-plus"></i> Nuevo usuario</button>
            </div>
            <?php endif;?>
          </div>

        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de usuarios</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla_usuarios" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nombres</th>
                <th>Rol</th>
                <th>Celular</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
              <?php
              while($row = sqlsrv_fetch_array($stmt)){
              ?>
              <tr>
                <td><?=$row['nombres'];?></td>
                <td><?=$row['rol'];?></td>
                <td><?=$row['celular'];?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?= $root;?>historial/?nid=<?= $row['idUsuario'] ?>"><i class="fas fa-notes-medical text-info"></i>  Mensajes programados</a>
                      <a class="dropdown-item" href="<?= $root;?>mensajes/add.php?nid=<?= $row['idUsuario'] ?>"><i class="fas fa-plus-circle text-primary"></i> Programar Mensaje</a>
                    
                      <?php if($rol == 'ADMIN'):?>
                      <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modal-editar-usuario" data-id="<?= $row['idUsuario']?>"> <i class="fas fa-pen text-success"></i> Editar</a>
                      <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modal-eliminar-usuario" data-id="<?= $row['idUsuario']?>" data-nombre="<?=$row['nombres']?>"><i class="fas fa-trash text-danger"></i> Eliminar</a>
                      <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modal-resetear-password" data-id="<?= $row['idUsuario']?>" data-nombre="<?=$row['nombres']?>"><i class="fas fa-lock text-info"></i>  Restablecer contraseña</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php
              }?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>

      </section>

  
    </div>
    <!-- /.content-wrapper -->

    <?php include_once('common/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- COMMON JS -->
  <script src="common/js/common.js"></script>

  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
    $("#tabla_usuarios").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "info": false
    });
  </script>
  <script src="dist/js/app-users.js"></script>
</body>

</html>