<?php 
session_start();
if(isset($_SESSION['usuario'])){
    ?><script>location.href="http://localhost/mvc/";</script><?php 
}
?>
<h1 class="center" style="text-align:center;background: #3498db;color: #fff;padding: 5px 15px;" >LOGIN</h1>
<title>SecuritySchool: Login</title>
<div class="container">
<div class="form-row">
<div class="form-group col-md-4">
<input type="button" class="btn btn-outline-info" id="loginalumno" value="Alumno">
<input type="button" class="btn btn-outline-info" id="loginadmin" value="Admin">
</div>
</div>
<div id="alumno">
<form method="post" id="formlogin" action="<?php echo constant('URL'); ?>login/loguear">
<div class="form-row">
    <div class="form-group col-md-4">
    <label for="matricula">Matricula</label>
    <input type="text" class="form-control" name="matricula" id="matricula" required>
    </div>
    <div class="form-group col-md-4">
    <label for="pass">Password</label>
    <input type="password" class="form-control" name="pass" id="pass" required>
    </div>
    </div>
    <input type="button" class="btn btn-outline-success" id="btnenviar" value="Enviar">
</form>
</div>

<div id="admin">
<form method="post" id="formlogina" action="<?php echo constant('URL'); ?>login/logueara">
<div class="form-row">
    <div class="form-group col-md-4">
    <label for="matricula">Matricula</label>
    <input type="text" class="form-control" name="matriculaa" id="matriculaa" required>
    </div>
    <div class="form-group col-md-4">
    <label for="pass">Password</label>
    <input type="password" class="form-control" name="passs" id="passs" required>
    </div>
    </div>
    <input type="button" class="btn btn-outline-primary" id="btnenviara" value="Enviar">
</form>
</div>
</div>
<script>
function validaForm(){
    if($("#matricula").val() == ""){
        alertify.error("El campo matricula no puede estar vacío");
        $("#matricula").focus();
        return false;
    }
    if($("#pass").val() == ""){
        alertify.error("El campo matricula no puede estar vacío");
        $("#pass").focus();
        return false;
    }
    return true; // Si todo está correcto
}
function validaForma(){
    if($("#matriculaa").val() == ""){
        alertify.error("El campo matricula no puede estar vacío");
        $("#matriculaa").focus();
        return false;
    }
    if($("#passs").val() == ""){
        alertify.error("El campo matricula no puede estar vacío");
        $("#passs").focus();
        return false;
    }
    return true; // Si todo está correcto
}
</script>
<script>
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    document.getElementById('admin').style.display = 'none';
    document.getElementById('loginalumno').disabled = true;
    $("#btnenviar").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForm()){    // Primero validará el formulario.
            $("#formlogin").submit();         
        }
        return false;
    });
    $("#loginalumno").click( function() {   
        document.getElementById('alumno').style.display = 'block';
        document.getElementById('admin').style.display = 'none';
        document.getElementById('loginalumno').disabled = true;
        document.getElementById('loginadmin').disabled = false;
    });
    $("#loginadmin").click( function() {   
        document.getElementById('alumno').style.display = 'none';
        document.getElementById('admin').style.display = 'block';
        document.getElementById('loginadmin').disabled = true;
        document.getElementById('loginalumno').disabled = false;
    });
    $("#btnenviara").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForma()){    // Primero validará el formulario.
            $("#formlogina").submit();         
        }
        return false;
    });
});
</script>