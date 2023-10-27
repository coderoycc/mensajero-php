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
include_once('../conexion.php');
if($rol != 'ADMIN'){
  $sql = "SELECT * FROM tblPacientes WHERE idUsuario = $id;";
}else{
  $sql = "SELECT * FROM tblPacientes;";
}
$stmt = sqlsrv_query($con, $sql);
if($stmt === false){
  header("Location: ./error.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios</title>

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
              <h1>Usuarios</h1>
            </div>
            <div class="col-sm-6">
              <a href="./add.php" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo Usuario</a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table_pacientes" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfonos</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody>
              <?php
              while($row = sqlsrv_fetch_array($stmt)){
                $formatFecha = date_format($row['fechaNacimiento'], 'd/m/Y');
              ?>
              <tr>
                <td><?=$row['idPaciente']?></td>
                <td><?=$row['nombre']?></td>
                <td><?=$row['telefono'];?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                      Acciones
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?= $root;?>historial/?nid=<?= $row['idPaciente']?>"><i class="fas fa-notes-medical text-info"></i>  Mensajes programados</a>
                      <a class="dropdown-item" href="<?= $root;?>mensajes/add.php?nid=<?= $row['idPaciente']?>"><i class="fas fa-plus-circle text-primary"></i> Programar Mensaje</a>
                      <a class="dropdown-item" href="<?= $root;?>users/edit.php?nid=<?= $row['idPaciente']?>"> <i class="fas fa-pen text-success"></i> Editar</a>
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
    const tam = window.innerHeight > 850 ? 8 : 6;
    const tamvh = window.innerHeight > 850 ? 53 : 47;
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
    $("#table_pacientes").DataTable({
      language: lenguaje,
      columnDefs: [
        {orderable: false, targets: [3]}
      ],
      "pageLength":tam,
      "scrollY":tamvh+"vh",
      "scrollX": true,
      "lengthChange": false, 
      "autoWidth": false,
      "info": false,
    })
  </script>
  <script src="./js/index.js"></script>
</body>

</html>