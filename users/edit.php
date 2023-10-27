<?php
session_start();
if(!isset($_SESSION['nombre']) && !isset($_SESSION['rol']) && !isset($_SESSION['id'])){
  header('Location: ../');
}else{
  $nombre = $_SESSION['nombre'];
  $id = $_SESSION['id'];
  $rol = $_SESSION['rol'];
}
include_once('../conexion.php');

$root = '../';
$sql = "SELECT * FROM tblPacientes WHERE idPaciente = " . $_GET['nid'];
$stmt = sqlsrv_query($con, $sql);
if($stmt && sqlsrv_has_rows($stmt) != false){
  $id = $_GET['nid'];
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  $fecha = $row['fechaNacimiento']->format('m/d/Y');
}else{
  header('Location: ./error.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Paciente</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

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
              <h1>Editar paciente </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <form id="update_paciente">
          <input type="hidden" name="idPaciente" value="<?=$id?>">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title ">Cambie los datos necesarios</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Nombre completo: </label>
                      <input type="text" name="nombre" class="form-control" value="<?= $row['nombre']?>" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Teléfono - Celular</label>
                      <input type="text" name="telefono" class="form-control" value="<?= $row['telefono']?>">
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Sexo: </label>
                      <select name="sexo" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="FEMENINO" <?= $row['sexo'] == 'FEMENINO' ? 'selected' : '' ?>>FEMENINO</option>
                        <option value="MASCULINO" <?= $row['sexo'] == 'MASCULINO' ? 'selected' : '' ?>>MASCULINO</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tipo de Sangre</label>
                      <select class="form-control" name="sangre" required>
                        <option value=""> -- Seleccione -- </option>
                        <option value="O Rh+" <?= $row['tipoSangre'] == 'O Rh+' ? 'selected' : '' ?>>O Rh+</option>
                        <option value="O Rh-" <?= $row['tipoSangre'] == 'O Rh-' ? 'selected' : '' ?>>O Rh-</option>
                        <option value="A Rh+" <?= $row['tipoSangre'] == 'A Rh+' ? 'selected' : '' ?>>A Rh+</option>
                        <option value="A Rh-" <?= $row['tipoSangre'] == 'A Rh-' ? 'selected' : '' ?>>A Rh-</option>
                        <option value="B Rh+" <?= $row['tipoSangre'] == 'B Rh+' ? 'selected' : '' ?>>B Rh+</option>
                        <option value="B Rh-" <?= $row['tipoSangre'] == 'B Rh-' ? 'selected' : '' ?>>B Rh-</option>
                        <option value="AB Rh+" <?= $row['tipoSangre'] == 'AB Rh+' ? 'selected' : '' ?>>AB Rh+</option>
                        <option value="AB Rh-" <?= $row['tipoSangre'] == 'AB Rh-' ? 'selected' : '' ?>>AB Rh-</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Fecha de nacimiento: (mes/dia/año)</label>
                        <div class="input-group date" id="fecha_nac" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#fecha_nac" name="fecha_nac" value="<?= $fecha ?>" required>
                          <div class="input-group-append" data-target="#fecha_nac" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-default" onclick="history.back()"><i class="fas fa-arrow-left"></i> CANCELAR</button>
              <button type="submit" id="btn-update" class="btn btn-info float-right"><i class="fas fa-save"></i> ACTUALIZAR</button>
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
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script src="js/app.js"></script>
</body>

</html>