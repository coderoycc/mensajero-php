<?php
include('../conexion.php');

$id = $_POST['id']; // id usuario en sesion
$sql = "SELECT tm.*, tu.nombres FROM 
tblMensaje as tm
INNER JOIN tblUsuario as tu
ON tm.idUsuarioDestino = tu.idUsuario
WHERE idUsuarioOrigen = $id;";
$stmt = sqlsrv_query($con, $sql);
if($stmt){
  $datos = array();
  while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $fecha = $row['fecha']->format('Y-m-d');
    $descrip = $row['nombres'].' - '.$row['mensaje'];
    $hora_fin = new DateTime($row['hora']);
    $hora_fin->add(new DateInterval('PT30M'));
    $hora_fin = $hora_fin->format('H:i');
    $cita = array('idUsuario'=>$id, 'mensaje'=>$descrip, 'fecha'=>$fecha, 'horaInicio'=>$row['hora'], 'horaFin'=>$hora_fin, 'color'=>$row['color']);
    array_push($datos, $cita);
  }
  echo json_encode(array('ok'=>true, 'data'=>$datos));
}else{
  // print_r(sqlsrv_errors($stmt));
  echo json_encode(array('ok'=>false,'error'=>'Error al obtener mensajes'));
}
?>