<?php

include('../conexion.php');
$fecha = explode("/", $_POST['fecha']);
$fecha_format = $fecha[2]."-".$fecha[1]."-".$fecha[0];

$sql = "INSERT INTO tblMensaje(mensaje, fecha, color, hora, idUsuarioOrigen, idUsuarioDestino)
VALUES (?,?,?,?,?,?)";
$params = array($_POST['mensaje'], $fecha_format, $_POST['color'], $_POST['hora'], $_POST['idUsuario'], $_POST['idDestino']);

$stmt = sqlsrv_query($con, $sql, $params);
if($stmt){
  echo json_encode(array('ok'=>true));
}else{
  echo json_encode(array('ok'=>false));
  print_r(sqlsrv_errors($stmt));
}
?>