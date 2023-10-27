<?php
include('../conexion.php');

$id = $_POST['idUsuario'];
$user = $_POST['user'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];
$celular = $_POST['celular'];
$sql = "UPDATE tblUsuario SET usuario='$user', nombres='$nombre', rol='$rol', celular='$celular' WHERE idUsuario='$id'";
$stmt = sqlsrv_query($con, $sql);
if($stmt){
  echo json_encode(array('ok' => true));
}else{
  echo json_encode(array('ok' => false));
}
?>