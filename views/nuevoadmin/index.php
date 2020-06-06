<?php require_once 'sesiones/checar2.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
</head>
<body>

  <?php require 'views/header.php';?>

      <h1 class="center">Nuevo Admin</h1>

      <form action="<?php echo constant('URL'); ?>nuevoadmin/registrarAdmin" method="POST" 
      enctype="multipart/form-data" id="formnew">
      <div class="form-row">
      <div class="form-group col-md-2">
            <label for="matricula">Matricula</label><br>
            <input type="text" class="form-control" name="matricula" id="matricula" required>
       </div>
       <div class="form-group col-md-2">
            <label for="nombre">Nombre</label><br>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
       </div>
       <div class="form-group col-md-2">
            <label for="apellido">Apellido</label><br>
            <input type="text" class="form-control" name="apellido" id="apellido" required>
       </div>
       <div class="form-group col-md-2">
            <label for="phone">Teléfono</label><br>
            <input type="text" class="form-control" name="telefono" id="telefono" required>
       </div>
       <div class="form-group col-md-2">
            <label for="email">Email</label><br>
            <input type="email" class="form-control" class="form-control" name="email" id="email" required>
       </div>
       <div class="form-group col-md-2">
       <label for="pass">Password</label><br>
            <input type="password" class="form-control" name="pass" id="pass" required>
       </div>
       </div>
       <div class="form-row">
       <div class="form-group col-md-4">
            <label for="img">Fotografía</label><br>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" required>
       </div>
       </div>
       <input type="button" value="Registrar Admin" style="color:black;" class="btn btn-outline-success"
       id="btnenviar">
       <a class="btn btn-outline-danger" href="<?php echo constant('URL').'admins'?>" style="color:black;">Cancelar</a>
       </div>
      </form>
     <br>
  <?php require 'views/footer.php';?>

</body>
</html>

<script>
function validaForm(){
     //EXPRESION REGULAR SOLO NUMEROS
     const pattern = new RegExp('^[0-9]+$');
     //EXPRESION REGULAR SOLO LETRAS
     const letras = new RegExp('^[A-Z]+$', 'i');
     //EXPRESION REGULAR SOLO LETRAS Y NUMEROS
     const letrasn = new RegExp(/^[A-Za-z0-9\s]+$/g);
    if($("#matricula").val() == ""){
        alertify.error("El campo matricula no puede estar vacío");
        $("#matricula").focus();
        return false;
    }
    if(!pattern.test($("#matricula").val())){
        alertify.error("El campo matricula solo puede contener numeros");
        $("#matricula").focus();
        return false;
    }
    if(($("#matricula").val().length<10)|| ($("#matricula").val().length>10) ){
        alertify.error("El campo matricula debe tener 10 digitos");
        $("#matricula").focus();
        return false;
    }
    if($("#nombre").val() == ""){
        alertify.error("El campo nombre no puede estar vacío");
        $("#nombre").focus();
        return false;
    }
    if(!letras.test($("#nombre").val())){
        alertify.error("El campo nombre solo puede contener letras");
        $("#nombre").focus();
        return false;
    }
    if($("#apellido").val() == ""){
        alertify.error("El campo apellido no puede estar vacío");
        $("#apellido").focus();
        return false;
    }
    if(!letras.test($("#apellido").val())){
        alertify.error("El campo apellido solo puede contener letras");
        $("#apellido").focus();
        return false;
    }
    if($("#pass").val() == ""){
        alertify.error("El campo password no puede estar vacío");
        $("#pass").focus();
        return false;
    }
    if($("#telefono").val() == ""){
        alertify.error("El campo telefono no puede estar vacío");
        $("#telefono").focus();
        return false;
    }
    if(!pattern.test($("#telefono").val())){
        alertify.error("El campo telefono solo puede contener numeros");
        $("#telefono").focus();
        return false;
    }
    if(($("#telefono").val().length<10)|| ($("#telefono").val().length>10) ){
        alertify.error("El campo telefono debe tener 10 digitos");
        $("#telefono").focus();
        return false;
    }
    if($("#email").val() == ""){
        alertify.error("El campo Email no puede estar vacío");
        $("#email").focus();
        return false;
    }
    if($("#imagen").val() == ""){
        alertify.error("No se ha elegido ninguna fotografía");
        return false;
    }
    return true; // Si todo está correcto
}
</script>
<script>
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#btnenviar").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForm()){    // Primero validará el formulario.
            $("#formnew").submit();         
        }
        return false;
    });
});
</script>