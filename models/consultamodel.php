<?php

include_once 'models/alumno.php';

class ConsultaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT *FROM alumnos");

            while($row = $query->fetch()){
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre    = $row['nombre'];
                $item->apellido  = $row['apellido'];
                $item->edad      = $row['edad'];
                $item->sexo      = $row['sexo'];
                $item->direccion = $row['direccion'];
                $item->ciudad    = $row['ciudad'];
                $item->telefono  = $row['telefono'];
                $item->cp        = $row['cp'];
                $item->email     = $row['email'];
                $item->pass      = $row['pass'];
                $item->avatar    = $row['avatar'];

                array_push($items, $item);
            }
              return $items;
        }catch(PDOException $e){
          return [];
        }
        
    }

    public function getById($id){
        $item = new Alumno();

        $query = $this->db->connect()->prepare("SELECT * FROM alumnos WHERE matricula = :matricula");
        try{
            $query->execute(['matricula' => $id]);

            while($row = $query->fetch()){
                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
                $item->edad      = $row['edad'];
                $item->sexo      = $row['sexo'];
                $item->direccion = $row['direccion'];
                $item->ciudad    = $row['ciudad'];
                $item->telefono  = $row['telefono'];
                $item->cp        = $row['cp'];
                $item->email     = $row['email'];
                $item->pass      = $row['pass'];
                $item->avatar    = $row['avatar'];
            }

            return $item;
        }catch(PDOException $e){
            return null;

        }

    }
    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE alumnos SET nombre = :nombre, apellido = :apellido,
        edad = :edad, sexo = :sexo, direccion = :direccion, ciudad = :ciudad, telefono = :telefono,
        cp = :cp, email = :email, pass = :pass, avatar = :avatar
         WHERE matricula =:matricula");
        try{
            $query->execute([
                'matricula'=> $item ['matricula'],
                'nombre'   => $item ['nombre'],
                'apellido' => $item ['apellido'],
                'edad'     => $item ['edad'],
                'sexo'     => $item ['sexo'],
                'direccion'=> $item ['direccion'],
                'ciudad'   => $item ['ciudad'],
                'telefono' => $item ['telefono'],
                'cp'       => $item ['cp'],
                'email'    => $item ['email'],
                'pass'     => $item ['pass'],
                'avatar'   => $item ['avatar'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function updatefile($archivo,$matricula){
        unlink('C:/xampp/htdocs/mvc/'.$archivo);
    } 
    public function enviaremail($pass,$email,$matricula){
        $subject="Actualizacion de contrasena";
        $message="Se han actualizado tus datos de inicio de sesion. Matricula".$matricula." Y password: ".$pass;
        $mail= new PHPMailer();
        $mail->IsSMTP();
        //Configuracion servidor mail
        $mail->From = "luceroitzel043@gmail.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; //seguridad
        $mail->Host = "smtp.gmail.com"; // servidor smtp
        $mail->Port = 587; //puerto
        $mail->Username ='luceroitzel043@gmail.com'; //nombre usuario
        $mail->Password = 'luceroitzel22'; //contraseña
        //Agregar destinatario
        $mail->AddAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        //Avisar si fue enviado o no y dirigir al index
        if ($mail->Send()) {
            echo'<script type="text/javascript">
                   alert("Enviado Correctamente");
                </script>';
        } else {
            echo'<script type="text/javascript">
                   alert("NO ENVIADO, intentar de nuevo");
                </script>';
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM alumnos WHERE matricula =:id");
        try{
            $carpeta='C:/xampp/htdocs/mvc/avatars/'.$id;
            foreach(glob($carpeta . "/*") as $archivos_carpeta){             
                if (is_dir($archivos_carpeta)){
                  rmDir_rf($archivos_carpeta);
                } else {
                unlink($archivos_carpeta);
                }
              }
            rmdir($carpeta);
            $query->execute([
                'id'=> $id,
 
            ]);
            return true;
        }catch(PDOException $e){
            return false;
            
        }
    }
}
?>

