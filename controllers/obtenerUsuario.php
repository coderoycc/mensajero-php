<?php
include('../conexion.php');
$res = array('ok'=>false, 'msg'=>'');
$id = $_POST['id'];
if($id!=""){
  $sql = "SELECT idUsuario, usuario, nombres, rol, celular FROM tblUsuario WHERE idUsuario = $id";
  $stmt = sqlsrv_query($con, $sql);
  if($stmt && sqlsrv_has_rows($stmt)>0){
    $res['ok'] = true;
    $res['data'] = sqlsrv_fetch_array($stmt);
  }else{
    $res['msg'] = 'No se encontro el usuario'; 
  }
}else{
  $res['msg'] = 'ID invalido';
}
echo json_encode($res);
?>