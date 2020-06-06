<?php 
class Ayuda extends controller{
    function __construct(){
        parent::__construct();
        
    }
    function render(){
        $this->view->reder('ayuda/index');
    }
}
?>

