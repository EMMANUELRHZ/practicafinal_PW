<?php
session_start();
if($_SESSION['usuario']=="alumno"){
    ?><script>location.href = "http://localhost/mvc/";</script><?php 
}
if($_SESSION['usuario']==null){
    ?><script>location.href = "http://localhost/mvc/login";</script><?php 
}
if($_SESSION['usuario']=="admin"){
    
}
?>
