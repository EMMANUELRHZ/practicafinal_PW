<?php 
class Main extends controller{
function __construct(){
    parent::__construct();
   
   // echo '<p>Nueva Controlador Main</p>';   
}
function render(){
    $this->view->reder('main/index');
}
}
 ?>


 