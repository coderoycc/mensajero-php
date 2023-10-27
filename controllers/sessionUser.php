<?php
class User{
  private $id;
  private $name;
  private $rol;
  function __construct(){
    $this->id=-1;
    $this->name='';
    $this->rol='';
  }
  function instance($id, $nom, $rol){
    $this->id=$id;
    $this->name=$nom;
    $this->rol=$rol;
  }
  function startSession(){
    session_start();
    $_SESSION['nombre'] = $this->name;
    $_SESSION['id'] = $this->id;
    $_SESSION['rol'] = $this->rol;
  }

  function isAdmin(){
    return $this->rol == 'ADMIN';
  }
  function destroySession(){
    session_start();
    try{
      unset($_SESSION['nombre']);
      unset($_SESSION['rol']);
      unset($_SESSION['id']);
      session_destroy();
      return true;
    }catch(Exception $e){
      return false;
    }
  }
  function isLogged(){
    session_start();
    return isset($_SESSION['id']) || isset($_SESSION['nombre']) || isset($_SESSION['rol']);
  }
  
}
?>