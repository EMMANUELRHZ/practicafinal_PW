<?php

class  LoginModel extends Model{

    public function __construct(){
        parent::__construct();
    }
public function loguear($matricula,$pass){
    $consulta = "SELECT matricula,pass FROM alumnos WHERE matricula = '$matricula' and pass = '$pass' ";
        $query = $this->db->connect()->prepare($consulta);
        $query->execute();
        $cuenta = $query->rowCount();
        if($cuenta!=0){
           return true;
        }
        else{
            return false;
        }
    }
    public function logueara($matricula,$pass){
        $consulta = "SELECT matricula,pass FROM admins WHERE matricula = '$matricula' and pass = '$pass' ";
            $query = $this->db->connect()->prepare($consulta);
            $query->execute();
            $cuenta = $query->rowCount();
            if($cuenta!=0){
               return true;
            }
            else{
                return false;
            }
        }
}