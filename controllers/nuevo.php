<?php 
class Nuevo extends controller{
function __construct(){
    parent::__construct();
    $this->view->mensaje = "";
    $this->view->reder('nuevo/index');
   // echo '<p>Nuevo Controlador Main</p>';   
}
function render(){
  
}

function registrarAlumno(){
    $matricula = $_POST['matricula'];
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $edad      = $_POST['edad'];
    $sex       = $_POST['sexo'];
    $direccion = $_POST['direccion'];
    $ciudad    = $_POST['city']; 
    $telefono  = $_POST['telefono'];
    $cp        = $_POST['cp'];
    $email     = $_POST['email'];
    $passnohash= $_POST['pass']; 
    $pass      = md5($_POST['pass']);
    if(!$this->model->enviaremail($passnohash,$email,$matricula)){
    $formatospermitidos=array("image/gif","image/png","image/jpeg");
    $limite_kb=1000*1024;
    if(in_array($_FILES['imagen']['type'],$formatospermitidos)&&
     $_FILES["imagen"]["size"]<=($limite_kb)){
         $ruta='avatars/'.$matricula.'/';
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
                'apellido' => $apellido, 'edad' => $edad, 'sexo' => $sex, 'direccion' => $direccion,
                'ciudad' => $ciudad, 'telefono' => $telefono, 'cp' => $cp, 'email' => $email,
                'pass' => $pass, 'avatar' => $archivo] )){
                    ?><script> alertify.success('Alumno dado de alta');  </script><?php
                    ?><script>location.href = "http://localhost/mvc/consulta";    </script><?php 
                }else{
                    ?><script> alertify.error('ERROR: El Alumno ya esta dado de Alta');  </script><?php
                }
            }
         }else{
            ?><script> alertify.error('ERROR: El Alumno ya esta dado de Alta');  </script><?php
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


 

