<?php
include('../conexion.php');

$user = $_POST['user'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];
$numero = $_POST['numero'];
$pass = "sysmedic*";
$sql = "INSERT INTO tblUsuario(usuario, nombres, rol, password, celular) VALUES (?,?,?,?,?);";
$stmt = sqlsrv_query($con, $sql, array($user, $nombre, $rol, $pass, $numero));
if($stmt){
  echo json_encode(array('ok'=>true));
}else{
  echo json_encode(array('ok'=>false));
}
?>