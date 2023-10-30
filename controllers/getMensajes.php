<?php
include('../conexion.php');

$id = $_POST['id']; // id usuario en sesion
$sql = "SELECT tm.*, tu.nombres FROM 
tblMensaje as tm
INNER JOIN tblUsuario as tu
ON tm.idUsuarioDestino = tu.idUsuario
WHERE idUsuarioOrigen = $id
AND tm.estado LIKE 'NO ENVIADO';";
$stmt = sqlsrv_query($con, $sql);
if($stmt){
  $datos = array();
  while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $fecha = $row['fecha']->format('Y-m-d');
    $descrip = $row['nombres'].' - '.$row['mensaje'];
    $hora_ini = $row['hora']->format('H:i');
    $hora_fin = date('H:i', strtotime('+30 minutes', strtotime($hora_ini)));
    $cita = array('idUsuario'=>$id, 'mensaje'=>$descrip, 'fecha'=>$fecha, 'horaInicio'=>$hora_ini, 'horaFin'=>$hora_fin, 'color'=>$row['color']);
    array_push($datos, $cita);
  }
  echo json_encode(array('ok'=>true, 'data'=>$datos));
}else{
  // print_r(sqlsrv_errors($stmt));
  echo json_encode(array('ok'=>false,'error'=>'Error al obtener mensajes'));
}
?>