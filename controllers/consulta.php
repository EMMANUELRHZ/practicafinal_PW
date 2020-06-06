<?php 
class Consulta extends controller{
function __construct(){
    parent::__construct();
    $this->view->alumnos = [];
  
   // echo '<p>Nueva Controlador Main</p>';   
}

function render(){
    $alumnos = $this->model->get();
    $this ->view->alumnos = $alumnos;
    $this->view->reder('consulta/index');
}

function verAlumno($param = null){
    $idAlumno = $param[0];
    $alumno = $this->model->getById($idAlumno);

    session_start();
    $_SESSION['id_verAlumno'] = $alumno->matricula;
    $this->view->alumno = $alumno;
    $this->view->mensaje = "";
    $this->view->reder('consulta/detalle');

}

function actualizarAlumno(){
    session_start();
    $matricula = $_SESSION['id_verAlumno'];
    $nombre    = $_POST['nombre'];
    $apellido  = $_POST['apellido'];
    $edad      = $_POST['edad'];
    $sex       = $_POST['sexo'];
    $direccion = $_POST['direccion'];
    $ciudad    = $_POST['city']; 
    $telefono  = $_POST['telefono'];
    $cp        = $_POST['cp'];
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
                echo "Archivo Guardado";
                if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 
                'apellido' => $apellido, 'edad' => $edad, 'sexo' => $sex, 'direccion' => $direccion,
                'ciudad' => $ciudad, 'telefono' => $telefono, 'cp' => $cp, 'email' => $email,
                'pass' => $pass, 'avatar' => $archivo ])){
           //actualizar alumno exito 
           $alumno = new Alumno();
           $alumno->matricula = $matricula;
           $alumno->nombre = $nombre;
           $alumno->apellido = $apellido;
           $alumno->edad= $edad;
           $alumno->sexo= $sex;
           $alumno->direccion= $direccion;
           $alumno->ciudad= $ciudad;
           $alumno->telefono= $telefono;
           $alumno->cp= $cp;
           $alumno->email= $email;
           $alumno->pass= $pass;
           $alumno->avatar = $avatar;
    
           $this->view->alumno = $alumno;
           $this->view->mensaje = "Alumno actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el alumno";
        }
            }
         }else{
             echo "Archivo ya existe";
         }
        header('Location: http://localhost/mvc/consulta ');
    }
    }
        else{
    if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 
    'apellido' => $apellido, 'edad' => $edad, 'sexo' => $sex, 'direccion' => $direccion,
    'ciudad' => $ciudad, 'telefono' => $telefono, 'cp' => $cp, 'email' => $email,
    'pass' => $pass,'avatar' => $avatar
    ])){
       //actualizar alumno exito 
       $alumno = new Alumno();
       $alumno->matricula = $matricula;
       $alumno->nombre = $nombre;
       $alumno->apellido = $apellido;
       $alumno->edad= $edad;
       $alumno->sexo= $sex;
       $alumno->direccion= $direccion;
       $alumno->ciudad= $ciudad;
       $alumno->telefono= $telefono;
       $alumno->cp= $cp;
       $alumno->email= $email;
       $alumno->pass= $pass;
       $alumno->avatar = $avatar;

       $this->view->alumno = $alumno;
       $this->view->mensaje = "Alumno actualizado correctamente";
    }else{
        // mensaje de error
        $this->view->mensaje = "No se pudo actualizar el alumno";
    }
    header('Location: http://localhost/mvc/consulta ');
}
}
function eliminarAlumno($param = null){
    $matricula = $param[0];
    

    if($this->model->delete($matricula)){
        //$this->view->mensaje = "Alumno eliminado correctamente";
     }else{
         // mensaje de error
         //$this->view->mensaje = "No se pudo eliminar el alumno";
         ?><script>alertify.error('Error al eliminar el alumno.')</script><?php
     }
     //$this->render();


}

}
 ?>



 
