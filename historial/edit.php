<?php
session_start();
if(!isset($_SESSION['nombre']) && !isset($_SESSION['rol']) && !isset($_SESSION['id'])){
  header('Location: ../');
  die();
}else{
  $nombre = $_SESSION['nombre'];
  $id = $_SESSION['id'];
  $rol = $_SESSION['rol'];
}
$root = '../';
include_once('../conexion.php');
date_default_timezone_set('America/La_Paz');

$sql = "SELECT tp.nombre, tc.* FROM tblConsultas AS tc
JOIN tblPacientes AS tp
on tp.idPaciente = tc.idPaciente
WHERE tc.idConsulta = ? 
ORDER BY tc.fecha DESC;";
$id = $_GET['cid'];
$stmt = sqlsrv_query($con, $sql, array($id));
if($stmt === false || sqlsrv_has_rows($stmt) === false){
  header('Location: ../');
  die();
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$fecha = $row['fecha']->format('m/d/Y');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar consulta</title>

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
              <h1>Editar consulta </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <form id="edit_consulta" onsubmit="return false;">
          <input type="hidden" name="idConsulta" value="<?=$row['idConsulta']?>">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Editar consulta</h3>
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
                    <label>Paciente: </label>
                    <input type="text" class="form-control" value="<?=$row['nombre']?>" disabled>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Fecha consulta: (dia/mes/año)</label>
                    <div class="input-group date">
                      <input type="text" class="form-control" value="<?=$fecha?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Hora consulta:</label>
                    <div class="input-group date">
                      <input type="text" class="form-control" value="<?=$row['hora']?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div id="imc_info">
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Peso [kg]:</label>
                    <div class="input-group">
                      <input type="decimal" class="form-control" name="peso" id="peso" value="<?=$row['peso']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Talla [cm]:</label>
                    <div class="input-group"> 
                      <input type="decimal" class="form-control" name="talla" id="talla" value="<?=$row['talla']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>PA:</label>
                    <div class="input-group">
                      <input type="decimal" class="form-control" name="pa" placeholder="Presión arterial" value="<?=$row['PA']?>">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>FR:</label>
                    <div class="input-group "> 
                      <input type="decimal" class="form-control" name="fr" placeholder="Frecuencia rítmica" value="<?=$row['FR']?>">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Pulso:</label>
                    <div class="input-group "> 
                      <input type="decimal" class="form-control" name="pulso" placeholder="Pulso" value="<?=$row['pulso']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">lpm</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Temperatura [°C]:</label>
                    <div class="input-group "> 
                      <input type="decimal" class="form-control" name="temperatura" placeholder="Temperatura" value="<?=$row['temperatura']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Motivo Consulta: </label>
                    <div class="input-group"> 
                      <textarea class="form-control" rows="3" style="resize: none;" name="motivo" maxlength="600"><?=$row['motivo']?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Diagnóstico: </label>
                    <div class="input-group"> 
                      <textarea class="form-control" rows="3" style="resize: none;" name="diagnostico" maxlength="600"><?=$row['diagnostico']?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Observaciones: </label>
                    <div class="input-group"> 
                      <textarea class="form-control" rows="3" style="resize: none;" name="observaciones" maxlength="600"><?=$row['observaciones']?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Receta: </label>
                    <div class="input-group"> 
                      <textarea class="form-control" rows="3" style="resize: none;" name="receta" maxlength="600"><?=$row['receta']?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-default" onclick="history.back()"><i class="fas fa-arrow-left"></i> CANCELAR</button>
              <button class="btn btn-success float-right" onclick="enviarDatos(evento)"><i class="fas fa-save"></i> REGISTRAR</button>
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