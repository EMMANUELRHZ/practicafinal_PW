<?php

include_once 'models/alumno.php';

class AdminsModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT *FROM admins");

            while($row = $query->fetch()){
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre    = $row['nombre'];
                $item->apellido  = $row['apellido'];
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
        $query = $this->db->connect()->prepare("SELECT * FROM admins WHERE matricula = :matricula");
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
        $query = $this->db->connect()->prepare("UPDATE admins SET nombre = :nombre, apellido = :apellido,
        telefono = :telefono, email = :email, pass = :pass, avatar = :avatar
         WHERE matricula =:matricula");
        try{
            $query->execute([
                'matricula'=> $item ['matricula'],
                'nombre'   => $item ['nombre'],
                'apellido' => $item ['apellido'],
                'telefono' => $item ['telefono'],
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
        $mail->Send();
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM admins WHERE matricula =:id");
        try{
            $carpeta='C:/xampp/htdocs/mvc/avatars/Admins/'.$id;
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

