<?php
include('../conexion.php');
$id = $_POST['idUsuario'];
$pass = $_POST['pass'];
$new = $_POST['newPass'];

$sql = "SELECT * FROM tblUsuario WHERE idUsuario = $id AND password = '$pass'";
$stmt = sqlsrv_query($con, $sql);
if($stmt){
  if(sqlsrv_has_rows($stmt) > 0){
    $sqlUpdate = "UPDATE tblUsuario SET password = '$new' WHERE idUsuario = $id";
    $stmtUpdate = sqlsrv_query($con, $sqlUpdate);
    if($stmtUpdate){
      echo json_encode(array('ok'=>true));
    }else{
      echo json_encode(array('ok'=>false, 'msg'=>'Error al actualizar contraseña'));
    }
  }else{
    echo json_encode(array('ok'=>false,'msg'=>'Tu contraseña actual es incorrecta'));
  }
}else{
  echo json_encode(array('ok'=>false,'msg'=>'Error Servidor'));
}
?>