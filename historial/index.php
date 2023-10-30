<?php
session_start();
if(!isset($_GET['nid'])){
  header('Location: ../');
  die();
}
if(!isset($_SESSION['nombre']) && !isset($_SESSION['rol']) && !isset($_SESSION['id'])){
  header('Location: ../');
}else{
  $nombre = $_SESSION['nombre'];
  $id = $_SESSION['id'];
  $rol = $_SESSION['rol'];
}
$root = '../';
include_once('../conexion.php');

$idUsuario = $_GET['nid'];
$sql = "SELECT * FROM tblMensaje
WHERE idUsuarioDestino = $idUsuario 
AND idUsuarioOrigen = $id
ORDER BY fecha DESC";
$stmt = sqlsrv_query($con, $sql);
$stmtName = sqlsrv_query($con, "SELECT nombres FROM tblUsuario WHERE idUsuario = $idUsuario");
if($stmt === false || $stmtName === false){
  header("Location: ./error.php");
}
$nombrePac = sqlsrv_fetch_array($stmtName)['nombres'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mensajes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include_once('../views/modalEliminarPaciente.php');?>
  <input type="hidden" id="idEliminar" value="">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include_once('../common/header.php');?>

    <!-- Main Sidebar Container -->
    <?php include_once('../common/menu.php');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mensajes programados </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      
      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Mensajes para: <b><?=$nombrePac?></b></h3>
            <div class="card-tools">
              <button class="btn btn-danger" onclick="history.back()"><i class="fas fa-arrow-left"></i> Volver</button>
              <a href="../mensajes/add.php?nid=<?=$idUsuario?>" class="btn btn-success"><i class="fas fa-plus"></i> Programar nuevo mensaje</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table_historial" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>FECHA - HORA</th>
                <th>MENSAJE</th>
                <th>ESTADO</th>
              </tr>
              </thead>
              <tbody>
              <?php
              while($row = sqlsrv_fetch_array($stmt)){
                $fecha = date_format($row['fecha'], 'd/m/Y');
              ?>
              <tr>
                <td><?=$fecha?> - <?=date('H:i', strtotime($row['hora']->format('H:i')))?></td>
                <td><?=$row['mensaje'];?></td>
                <td><?=$row['estado'];?></td>
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

    <?php include_once('../common/footer.php');?>

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
  
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script>
    const lenguaje = {
      processing: 'Procesando...',
      search: 'Buscar en la tabla',
      paginate: {
        first: 'Primero',
        previous: 'Anterior',
        next: 'Siguiente',
        last: 'Último'
      },
      emptyTable: 'No hay registros...',
      infoEmpty: 'No hay resultados',
      zeroRecords: 'No hay registros...',
    }
    $("#table_historial").DataTable({
      language: lenguaje,
      columnDefs: [
        {orderable: false, targets: [0]}
      ],
      "scrollX": true,
      "lengthChange": false, 
      "autoWidth": false,
      "info": false
    })
  </script>
  <script src="./js/app.js"></script>
</body>

</html>