<?php 
class view{
    function __construct(){
       // echo '<p>Vista base</p>';
    }
    function reder($nombre){
require 'views/' . $nombre . '.php';
    }
}
?>