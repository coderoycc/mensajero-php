<?php

include('../conexion.php');
$fecha_format = $_POST['fecha'];

$sql = "INSERT INTO tblMensaje(mensaje, fecha, color, hora, idUsuarioOrigen, idUsuarioDestino)
VALUES (?,?,?,?,?,?)";
$params = array($_POST['mensaje'], $fecha_format, $_POST['color'], $_POST['hora'], $_POST['idUsuario'], $_POST['idDestino']);
$stmt = sqlsrv_query($con, $sql, $params);

if($stmt){
  $sqlIdMensaje = "SELECT IDENT_CURRENT('tblMensaje') as idMensaje;";
  $queryidMensaje = sqlsrv_query($con, $sqlIdMensaje);
  $rowIdMensaje = sqlsrv_fetch_array($queryidMensaje);
  $idMensaje = $rowIdMensaje['idMensaje'];
  
  if (isset($_POST['checkDiaAntes']) && isset($_POST['checkHoraAntes'])) {
    $fecha2 = $_POST['fecha'];
    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha2);
    $fechaObj->modify('-1 day');
    $fechaUnDiaAntes = $fechaObj->format('Y-m-d');
    $horaUnahoraAntes = $_POST['hora'];

    $sqlRecordatorio = "INSERT INTO tblRecordatorio(idMensaje,fecha,hora) VALUES ($idMensaje,'$fechaUnDiaAntes','$horaUnahoraAntes');";
    $queryRecordatorio = sqlsrv_query($con, $sqlRecordatorio);

    $fechaUnDiaAntes = $fecha_format;
    $horaIngresada = $_POST["hora"];
    $horaObj = DateTime::createFromFormat('H:i', $horaIngresada);
    $horaObj->modify('-1 hour');
    $horaUnahoraAntes = $horaObj->format('H:i');

    $sqlRecordatorio = "INSERT INTO tblRecordatorio(idMensaje,fecha,hora) VALUES ($idMensaje,'$fechaUnDiaAntes','$horaUnahoraAntes');";
    $queryRecordatorio = sqlsrv_query($con, $sqlRecordatorio);

  } else if (isset($_POST['checkDiaAntes']) && !isset($_POST['checkHoraAntes'])) {
    $fecha2 = $_POST['fecha'];
    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha2);
    $fechaObj->modify('-1 day');
    $fechaUnDiaAntes = $fechaObj->format('Y-m-d');
    $horaUnahoraAntes = $_POST['hora'];

    $sqlRecordatorio = "INSERT INTO tblRecordatorio(idMensaje,fecha,hora) VALUES ($idMensaje,'$fechaUnDiaAntes','$horaUnahoraAntes');";
    $queryRecordatorio = sqlsrv_query($con, $sqlRecordatorio);
    
  } else if (!isset($_POST['checkDiaAntes']) && isset($_POST['checkHoraAntes'])) {
    $fechaUnDiaAntes = $fecha_format;
    $horaIngresada = $_POST["hora"];
    $horaObj = DateTime::createFromFormat('H:i', $horaIngresada);
    $horaObj->modify('-1 hour');
    $horaUnahoraAntes = $horaObj->format('H:i');

    $sqlRecordatorio = "INSERT INTO tblRecordatorio(idMensaje,fecha,hora) VALUES ($idMensaje,'$fechaUnDiaAntes','$horaUnahoraAntes');";
    $queryRecordatorio = sqlsrv_query($con, $sqlRecordatorio);
  }
}


if($stmt && $queryidMensaje){
  echo json_encode(array('ok'=>true));
}else{
  echo json_encode(array('ok'=>false));
  print_r(sqlsrv_errors($stmt));
}
?>