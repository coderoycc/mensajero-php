<?php
include_once('../conexion.php');
$idConsulta = $_POST['idConsulta'];

$sql = "UPDATE tblConsultas 
      SET talla = ?, peso = ?,
      PA = ?, pulso = ?, FR = ?, temperatura = ?,
      observaciones = ?, receta = ?, motivo = ?, 
      diagnostico = ? WHERE idPaciente = ?;";

$params = array($_POST['talla'], $_POST['peso'], $_POST['pa'], $_POST['pulso'], $_POST['fr'], $_POST['temperatura'], $_POST['observaciones'], $_POST['receta'], $_POST['motivo'], $_POST['diagnostico'], $idConsulta);
$stmt = sqlsrv_query($con, $sql, $params);
if($stmt){
  echo json_encode(array('ok' => true));
}else{
  echo json_encode(array('ok' => false));
}

?>