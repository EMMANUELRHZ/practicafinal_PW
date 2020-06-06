<?php 
class NuevoAdmin extends controller{
function __construct(){
    parent::__construct();
    $this->view->mensaje = "";
    $this->view->reder('nuevoadmin/index');
   // echo '<p>Nuevo Controlador Main</p>';   
}
function render(){
  
}

function registrarAdmin(){
    $matricula = $_POST['matricula'];
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $telefono  = $_POST['telefono'];
    $email     = $_POST['email'];
    $passnohash= $_POST['pass']; 
    $pass      = md5($_POST['pass']);
    if(!$this->model->enviaremail($passnohash,$email,$matricula)){
    $formatospermitidos=array("image/gif","image/png","image/jpeg");
    $limite_kb=1000*1024;
    if(in_array($_FILES['imagen']['type'],$formatospermitidos)&&
     $_FILES["imagen"]["size"]<=($limite_kb)){
         $ruta='avatars/Admins/'.$matricula.'/';
         $archivo=$ruta.$_FILES['imagen']['name'];
         if(!file_exists($ruta)){
             mkdir($ruta);
         }
         if(!file_exists($archivo)){
            $resultado= @move_uploaded_file($_FILES['imagen']['tmp_name'],$archivo);
            if(!$resultado){
                echo "No se guardo el archivo";
            }else{
                if($this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 
                'apellido' => $apellido, 'telefono' => $telefono, 'email' => $email,
                'pass' => $pass, 'avatar' => $archivo] )){
                    ?><script> alertify.success('Admin dado de alta');  </script>
                    <script>location.href = "http://localhost/mvc/admins"; </script><?php
                }else{
                    ?><script> alertify.error('ERROR: El Admin ya esta dado de Alta');  </script><?php
                }
            }
         }else{
            ?><script> alertify.error('ERROR: El Admin ya esta dado de Alta');  </script><?php
         }
}
else{
    ?><script> alertify.alert('ERROR DE ARCHIVO', 'El archivo seleccionado no es de formato PNG/GIF/JPG o sobrepasa los 1000kb', 
    function(){ });  </script><?php
    
}
    $this->render(); 
}
else{
    ?>
    <script> alertify.error('ERROR: Ocurrio un error al dar de alta el usuario');</script>
    <?php
}
}
}
 ?>


 

