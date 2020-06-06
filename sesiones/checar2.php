<?php 
session_start();
if($_SESSION['usuario']=="admin"){
  
}
else{
    ?><script>location.href = "http://localhost/mvc/login";</script><?php 
}
?>