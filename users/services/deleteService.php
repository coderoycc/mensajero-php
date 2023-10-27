<?php
include_once('../../conexion.php');

$response = array("code"=>0);
if(isset($_POST['idPaciente'])){
  $sql = "DELETE FROM tblPacientes 
  WHERE idPaciente = ?;";
  $stmt = sqlsrv_query($con, $sql, array($_POST['idPaciente']));
  if($stmt){
    $response['code'] = 1;
    $response['message'] = "Paciente eliminado correctamente";
  }else{
    $response['message'] = "Error al eliminar paciente";
  }
}else{
  $response['message'] = "[Parametro ID necesario]";
}
echo json_encode($response);

?>