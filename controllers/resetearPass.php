<?php
include('../conexion.php');
$pass = "sysmen*";
$id = $_POST['id'];
if($id!=''){
  $sql = "UPDATE tblUsuario SET password = '$pass' WHERE idUsuario = $id";
  $stmt = sqlsrv_query($con, $sql);
  if($stmt){
    echo json_encode(array('ok'=>true, 'mensaje'=>'Contraseña reseteada'));
  }else{
    echo json_encode(array('ok'=>false, 'mensaje'=>'Error al resetear contraseña'));
  }
}else{
  echo json_encode(array('ok'=>false, 'mensaje'=>'ID vacio'));
}
?>