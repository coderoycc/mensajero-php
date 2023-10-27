<?php
include_once('./sessionUser.php');
$user = new User();
if($user->destroySession()){
  echo json_encode(array('ok'=>true));
}else{
  echo json_encode(array('ok'=>false));
}

?>