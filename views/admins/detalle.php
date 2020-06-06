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
  <h1 class="center">Editar Admin</h1>
<form action="<?php echo constant('URL'); ?>admins/actualizarAdmin" method="POST"
      enctype="multipart/form-data" id="formedit">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="matricula">Matricula</label>
      <input type="text" class="form-control" name="matricula" 
      value="<?php echo $this->alumno->matricula; ?>" required disabled>
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Password</label>
      <input type="text" name="passold" id="passold"  value="<?php echo $this->alumno->pass; ?>" 
      style="display:none;">
      <input type="password" class="form-control" name="pass" id="pass" value="<?php echo $this->alumno->pass; ?>" 
      required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control" name="email" id="email"  value="<?php echo $this->alumno->email; ?>" 
      required>
    </div>
    <div class="form-group col-md-4">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $this->alumno->nombre; ?>"required>
  </div>
  <div class="form-group col-md-4">
    <label for="apellido">Apellidos</label>
    <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $this->alumno->apellido; ?>"required>
  </div>
    <div class="form-group col-md-4">
      <label for="telefono">Teléfono</label>
      <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $this->alumno->telefono; ?>" 
            required>
    </div>
    </div>
    <div class="form-group col-md-4">
    <label for="img">Avatar</label><br>
            <input type="text" name="avatar" id="avatar" value="<?php echo $this->alumno->avatar ?>" 
            style="display:none;">
          <img src=<?php echo constant('URL').$this->alumno->avatar; ?> width="80" height="80"><br>
            <input type="file" name="imagen" id="imagen" accept="image/*">
    </div>
  </div>
  <button type="button" class="btn btn-outline-success" style="color:black" id="btnenviar">Actualizar</button>
  <a class="btn btn-outline-danger" href="<?php echo constant('URL').'admins'?>" style="color:black;">Cancelar</a>
</form>
<br>
<?php require 'views/footer.php';?>
<script>
function validaForm(){
     //EXPRESION REGULAR SOLO NUMEROS
     const pattern = new RegExp('^[0-9]+$');
     //EXPRESION REGULAR SOLO LETRAS
     const letras = new RegExp('^[A-Z]+$', 'i');
     //EXPRESION REGULAR SOLO LETRAS Y NUMEROS
     const letrasn = new RegExp(/^[A-Za-z0-9\s]+$/g);
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
    return true; // Si todo está correcto
}
</script>
<script>
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#btnenviar").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForm()){    // Primero validará el formulario.
            $("#formedit").submit();         
        }
        return false;
    });
});
</script>