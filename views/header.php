<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title></title>
     
 <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/default.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo constant('URL'); ?>main">SecuritySchool</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo constant('URL'); ?>main">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL'); ?>consulta" id="alm">Alumnos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL'); ?>admins" id="adm">Admins</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <a href="<?php echo constant('URL')."sesiones/cerrara.php" ?>">Cerrar Sesión</a>
    </form>
  </div>
</nav>   
</body>
</html>
<?php
if($_SESSION['usuario']=="alumno"){
  ?>
  <script>
  document.getElementById('alm').style.display = 'none';
  document.getElementById('adm').style.display = 'none';
  </script>
  <?php
}
?>
