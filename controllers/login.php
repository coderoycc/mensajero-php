<?php
include("../conexion.php");
include('./sessionUser.php');
$user = $_POST['user'];
$pass = $_POST['pass'];
$sql = "SELECT idUsuario, nombres, rol FROM tblUsuario 
WHERE usuario = '$user' AND password = '$pass';";
$stmt = sqlsrv_query($con, $sql);
if($stmt && sqlsrv_has_rows($stmt) > 0){
  $row = sqlsrv_fetch_array($stmt);
  $user = new User();
  $user->instance($row['idUsuario'], $row['nombres'], $row['rol']);
  $user->startSession();
  echo json_encode(array('ok'=>true));
}else{
  // print_r(sqlsrv_errors($stmt));
  echo json_encode(array('ok'=>false));
}
?>