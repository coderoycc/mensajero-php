<?php
include_once('./controllers/sessionUser.php');
$user = new User();
if($user->isLogged()){
  include_once('views/main.php');
}else{
  include_once('views/login.php');
}
?>