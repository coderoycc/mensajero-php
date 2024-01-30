<?php
include('../conexion.php');
// no hay llaves foranea en tblRecordatorios
$id = $_POST['idMensaje'];
if($id!=''){
  $sql = "DELETE tblMensaje WHERE idMensaje = $id";
  $stmt = sqlsrv_query($con, $sql);
  if($stmt){
    $sql = "DELETE tblRecordatorio WHERE idMensaje = $id";
    $stmt2 = sqlsrv_query($con, $sql);
    if($stmt2){
      echo json_encode(array('status'=>'success', 'mensaje'=>'Usuario eliminado'));
    }else{
      echo json_encode(array('status'=>'success', 'mensaje'=>'Mensaje eliminado, pero no recordatorio'));
    }
  }else{
    echo json_encode(array('status'=>'error', 'mensaje'=>'Error al eliminar contraseña'));
  }
}else{
  echo json_encode(array('status'=>'error', 'mensaje'=>'ID vacio '));
}