<?php 
class Admins extends controller{
function __construct(){
    parent::__construct();
    $this->view->alumnos = [];
  
   // echo '<p>Nueva Controlador Main</p>';   
}

function render(){
    $alumnos = $this->model->get();
    $this ->view->alumnos = $alumnos;
    $this->view->reder('admins/index');
}

function verAlumno($param = null){
    $idAlumno = $param[0];
    $alumno = $this->model->getById($idAlumno);

    session_start();
    $_SESSION['id_verAlumno'] = $alumno->matricula;
    $this->view->alumno = $alumno;
    $this->view->mensaje = "";
    $this->view->reder('admins/detalle');

}

function actualizarAdmin(){
    session_start();
    $matricula = $_SESSION['id_verAlumno'];
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $telefono  = $_POST['telefono'];
    $email     = $_POST['email'];
    if($_POST['passold']==$_POST['pass']){
        $pass=$_POST['passold'];
    } 
    else{
        $passnohash=$_POST['pass'];
        $pass= md5($_POST['pass']);
        $this->model->enviaremail($passnohash,$email,$matricula);
    }
    $avatar    = $_POST['avatar'];
    unset($_SESSION['id_verAlumno']);
    $formatospermitidos=array("image/gif","image/png","image/jpeg");
    $limite_kb=1000*1024;
    if($_FILES['imagen']['tmp_name']!=null){
        $this->model->updatefile($avatar,$matricula);
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
                echo "Archivo Guardado";
                if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 
                'apellido' => $apellido, 'telefono' => $telefono, 'email' => $email,
                'pass' => $pass, 'avatar' => $archivo ])){
           //actualizar alumno exito 
           $alumno = new Alumno();
           $alumno->matricula = $matricula;
           $alumno->nombre = $nombre;
           $alumno->apellido = $apellido;
           $alumno->telefono= $telefono;
           $alumno->email= $email;
           $alumno->pass= $pass;
           $alumno->avatar = $avatar;
    
           $this->view->alumno = $alumno;
           $this->view->mensaje = "Admin actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el Admin";
        }
            }
         }else{
             echo "Archivo ya existe";
         }
        header('Location: http://localhost/mvc/admins ');
    }
    }
        else{
    if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 
    'apellido' => $apellido, 'telefono' => $telefono, 'email' => $email,
    'pass' => $pass,'avatar' => $avatar
    ])){
       //actualizar alumno exito 
       $alumno = new Alumno();
       $alumno->matricula = $matricula;
       $alumno->nombre = $nombre;
       $alumno->apellido = $apellido;
       $alumno->telefono= $telefono;
       $alumno->email= $email;
       $alumno->pass= $pass;
       $alumno->avatar = $avatar;

       $this->view->alumno = $alumno;
       $this->view->mensaje = "Admin actualizado correctamente";
    }else{
        // mensaje de error
        $this->view->mensaje = "No se pudo actualizar el Admin";
    }
    header('Location: http://localhost/mvc/admins ');
}
}
function eliminarAdmin($param = null){
    $matricula = $param[0];
    

    if($this->model->delete($matricula)){
        //$this->view->mensaje = "Alumno eliminado correctamente";
     }else{
         // mensaje de error
         //$this->view->mensaje = "No se pudo eliminar el alumno";
         ?><script>alertify.error('Error al eliminar usuario admin.')</script><?php
     }
     //$this->render();


}

}
 ?>


