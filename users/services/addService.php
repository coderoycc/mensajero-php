<?php
include_once("../../conexion.php");
session_start();
$idMedico = $_SESSION['id'];
$response = array("code"=>0);
if($_SERVER['REQUEST_METHOD']=='POST'){
  $nombre = $_POST['nombre'];
  $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
  $sql = "INSERT INTO tblPacientes (nombre, telefono, sexo, tipoSangre, fechaNacimiento, idUsuario) 
  VALUES (?, ?, ?, ?, ?, ?);";
  $stmt = sqlsrv_query($con, $sql, array($nombre, $telefono, $sexo, $sangre, $fecha_nac, $idMedico));
  if($stmt){
    $response['code'] = 1;
    $response['message'] = "Paciente agregado correctamente";
  }else{
    $response['message'] = "Error al agregar paciente";
  }
}else{
  $response['message'] = "[Metodo incorrecto]";
}
echo json_encode($response);
?>