<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['rol']) && !isset($_SESSION['id'])) {
  header('Location: ../');
} else {
  $nombre = $_SESSION['nombre'];
  $id = $_SESSION['id'];
  $rol = $_SESSION['rol'];
}
$root = '../';
include_once('../conexion.php');
date_default_timezone_set('America/La_Paz');
$fecha_consulta = date('d-m-Y');
$hora_consulta = date('H:i:s');
$nid = 0;
$opciones = '';
if (isset($_GET['nid']) && $_GET['nid'] != '' && $_GET['nid'] != 0) {
  $nid = $_GET['nid'];
  $stmt = sqlsrv_query($con, "SELECT idUsuario, nombres FROM tblUsuario WHERE idUsuario = $nid;");
  if ($stmt && sqlsrv_has_rows($stmt) > 0) {
    $row = sqlsrv_fetch_array($stmt);
  } else {
    include_once('../views/error.php');
    die();
  }
} else {
  include_once('../views/error.php');
  die();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo mensaje</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
              <h1>Nuevo mensaje programado</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <form id="add_cita">
          <input type="hidden" name="idUsuario" value="<?= $id ?>">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title ">Registro del mensaje</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Usuario: </label>
                    <input type="text" class="form-control" value="<?= $row['nombres'] ?>" disabled>
                    <input type="hidden" name="idDestino" value="<?= $nid ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Mensaje (requerido)</label>
                    <input type="text" class="form-control" name="mensaje" value="" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Fecha:</label>
                    <div class="flex-row">
                      <div class="input-group date" data-target-input="nearest">
                        <input type="date" class="form-control" name="fecha" id="fecha"/>
                        <div class="input-group-append">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                      <br>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkDiaAntes" name="checkDiaAntes">
                        <label class="form-check-label" for="checkDiaAntes">
                          Recordame un día antes
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Hora envío:</label>
                    <div class="input-group date" id="horaInicio" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" id="hora" data-target="#horaInicio" name="hora" required/>
                      <div class="input-group-append" data-target="#horaInicio" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                    <br>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="checkHoraAntes" name="checkHoraAntes">
                      <label class="form-check-label" for="checkHoraAntes">
                        Recordame una hora antes
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Color: </label>
                    <div class="input-group colorHexa">
                      <input type="text" class="form-control" name="color" style="cursor:pointer;" autocomplete="off">
                      <div class="input-group-append">
                        <span class="input-group-text" for="color"><i class="fas fa-square"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div id="imc_info">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-default" onclick="history.back()"><i class="fas fa-arrow-left"></i> CANCELAR</button>
              <button type="submit" id="btn-registrar" class="btn btn-success float-right"><i class="fas fa-save"></i> REGISTRAR</button>
            </div>
          </div>
        </form>
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
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../common/js/common.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script src="js/add.js"></script>
</body>

</html>