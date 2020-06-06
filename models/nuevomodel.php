<?php

class NuevoModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function insert($datos){
        //insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO alumnos (matricula, nombre, apellido,edad,
            sexo, direccion, ciudad, telefono, cp, email, pass,avatar) 
            VALUES(:matricula, :nombre, :apellido, :edad, :sexo, :direccion, :ciudad, :telefono, :cp, :email,
            :pass, :avatar)');
            $query->execute(['matricula' => $datos['matricula'],'nombre' => $datos['nombre'], 
            'apellido' => $datos['apellido'], 'edad' => $datos['edad'], 'sexo' => $datos['sexo'], 
            'direccion' => $datos['direccion'], 'ciudad' => $datos['ciudad'], 'telefono' => $datos['telefono'],
            'cp' => $datos['cp'], 'email' => $datos['email'], 'pass' => $datos['pass'], 'avatar' => $datos['avatar']]);
            return true;
        
        }catch(PDOException $e){
             echo $e->getMessage();
             //echo "Lucero, Ya existe esa matricula";
             return false;
        } 
    }
    public function enviaremail($pass,$email,$matricula){
        $subject="Registro exitoso";
        $message="Gracias por registrarte tus datos de inicio de sesión son: Matricula".$matricula." Y password: ".$pass;
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
        //Avisar si fue enviado o no y dirigir al index

}

}



