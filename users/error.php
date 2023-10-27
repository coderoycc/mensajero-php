<?php
session_start();
if(!isset($_SESSION['nombre']) && !isset($_SESSION['rol']) && !isset($_SESSION['id'])){
  header('Location: ../');
}else{
  $nombre = $_SESSION['nombre'];
  $id = $_SESSION['id'];
  $rol = $_SESSION['rol'];
}
$root = '../';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INICIO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="shortcut icon" href="<?= $root ?>assets/images/favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $root ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $root ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include_once('../common/header.php'); ?>

    <!-- Main Sidebar Container -->
    <?php include_once('../common/menu.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Inicio </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><i class="fas fa-user-plus"></i></h3>

                  <p>Agregar nuevo Usuario</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= $root ?>users/add.php" class="small-box-footer">Nuevo Usuario <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><i class="fas fa-eye"></i></h3>

                  <p>Lista de usuarios</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= $root ?>users.php" class="small-box-footer">Lista <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><i class="fas fa-prescription-bottle-alt"></i></h3>

                  <p>Agregar una nueva consulta</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="../consultas/add.php" class="small-box-footer">Nueva consulta <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <section class="content">

      <!-- Default box -->
        <div class="card card-danger">
          <div class="card-header ">
            <h3 class="card-title "><b class="text-center">¡UPPS! Algo salio mal</b></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            Ocurrio un error al procesar la solicitud. &nbsp; &nbsp;
            <a class="btn btn-info" href="<?= $root ?>"><i class="fas fa-arrow-left"></i> Volver al Inicio</a>
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>

    </div>
    <!-- /.content-wrapper -->

    <?php include_once('../common/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= $root ?>plugins/jquery/jquery.min.js"></script>
  <script src="../common/js/common.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= $root ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= $root ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= $root ?>dist/js/demo.js"></script>
</body>

</html>