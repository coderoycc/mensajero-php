<?php
include_once('../../conexion.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
  $nombre = $_POST['nombre'];
  $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
  $sexo = $_POST['sexo'];
  $sangre = $_POST['sangre'];
  $fecha_nac = $_POST['fecha_nac'];
  $id = $_POST['idPaciente'];
  $sql = "UPDATE tblPacientes SET nombre = ?, telefono = ?, sexo = ?, tipoSangre = ?, fechaNacimiento = ? WHERE idPaciente = ?";
  $stmt = sqlsrv_query($con, $sql, array($nombre, $telefono, $sexo, $sangre, $fecha_nac, $id));
  if($stmt){
    $response['code'] = 1;
    $response['message'] = "Paciente actualizado correctamente";
  }else{
    $response['message'] = "Error al actualizar a paciente";
  }
}else{
  $response['message'] = "[Metodo incorrecto]";
}
echo json_encode($response);

?>