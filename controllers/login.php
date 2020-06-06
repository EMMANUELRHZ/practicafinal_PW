<?php 
class Login extends controller{
function __construct(){
    parent::__construct();
    $this->view->reder('login/index');
   // echo '<p>Nuevo Controlador Main</p>';   
}
function render(){
  
}
function loguear(){
    $matricula= $_POST['matricula'];
    $pass= md5($_POST['pass']);
    if($this->model->loguear($matricula,$pass)){
        session_start();
        $_SESSION['usuario']="alumno";
        ?><script>location.href = "http://localhost/mvc/main";    </script><?php
    }
    else{
        ?><script>alertify.error("Matricula y/o Password Incorrectos")</script><?php
    }
}
function logueara(){
    $matricula= $_POST['matriculaa'];
    $pass= md5($_POST['passs']);
    if($this->model->logueara($matricula,$pass)){
        session_start();
        $_SESSION['usuario']="admin";
        ?><script>location.href = "http://localhost/mvc/consulta";    </script><?php
    }
    else{
        ?><script>alertify.error("Matricula y/o Password Incorrectos")</script><?php
    }
}
}