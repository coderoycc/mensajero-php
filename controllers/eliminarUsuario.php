<?php
include('../conexion.php');

$id = $_POST['id'];
if($id!=''){
  $sql = "DELETE tblUsuario WHERE idUsuario = $id";
  $stmt = sqlsrv_query($con, $sql);
  if($stmt){
    echo json_encode(array('ok'=>true, 'mensaje'=>'Usuario eliminado'));
  }else{
    echo json_encode(array('ok'=>false, 'mensaje'=>'Error al eliminar contraseña'));
  }
}else{
  echo json_encode(array('ok'=>false, 'mensaje'=>'ID vacio '));
}
?>