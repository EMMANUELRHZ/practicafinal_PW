<?php require('sesiones/comprobar.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SecuritySchool: Alumnos</title>
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
        <a class="nav-link" href="<?php echo constant('URL'); ?>consulta">Alumnos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="<?php echo constant('URL'); ?>admins">Admins</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" id="search" placeholder="Buscar..." aria-label="Search">
    <a href="<?php echo constant('URL')."sesiones/cerrara.php" ?>">Cerrar Sesión</a>
    </form>
  </div>
</nav>
<h1 class="center" style="text-align:center;background: #3498db;color: #fff;padding: 5px 15px;" >Alumnos</h1>
<div class="table-responsive">
<table class="table table-sm">
               <thead>
               <tr>
                         <th>Matricula</th>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Teléfono</th>
                         <th>Email</th>
                         <th>Fotografía</th>
                         <th></th>
                         <th><a href="<?php echo constant('URL'); ?>nuevo">Nuevo Alumno</a></th>
                     </tr>
               </thead>
               <tbody id="tbody-alumnos">
               <?php 
                   include_once 'models/alumno.php';
                   foreach ($this->alumnos as $row){
                       $alumno = new Alumno();
                       $alumno = $row;
                    
               ?>
                 <tr id="fila-<?php $alumno->matricula; ?>">
                 <td id="m"><?php echo $alumno->matricula; ?></td>
                 <td><?php echo $alumno->nombre; ?></td>
                   <td><?php echo $alumno->apellido; ?></td>
                   <td><?php echo $alumno->telefono; ?></td>
                   <td><?php echo $alumno->email; ?></td>
                   <td><img src=<?php echo $alumno->avatar;?> width="80" height="80"></td>
                   <td><a class="btn btn-outline-warning" 
                   href="<?php echo constant('URL') . 'consulta/verAlumno/' . $alumno->matricula; 
                   ?>" >Editar </a>
                   <!--<td><a href="<?php echo constant('URL') . 'consulta/eliminarAlumno/' . $alumno->matricula; ?>">Eliminar </a></td>-->
                   <button class="btn btn-outline-danger bEliminar" 
                   data-matricula="<?php echo $alumno->matricula; ?>">Eliminar</button></td>
                 </tr>
                   <?php } ?>
               </tbody>
        </table>
    </div>
    <script src="<?php echo constant('URL') ?>public/js/main.js"></script>
</body>
</html>
<script>
$(function () {
$('#search').quicksearch('table tbody tr ');								
});
</script>