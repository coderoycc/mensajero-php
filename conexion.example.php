<?php

$serverName = "";
$connectionInfo = array("Database"=>"", "Uid"=>"", "PWD"=>"---", "CharacterSet"=>"UTF-8");
$con=sqlsrv_connect($serverName,$connectionInfo);
 if ($con){
 }
 else
 {
  echo 'No puede conectarse con la base de datos';
 }