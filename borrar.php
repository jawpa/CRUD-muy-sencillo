<?php 
   include 'conexion.php';

   // capturamos el parámetro id que nos envía el enlace enlazado al botón en la página cr
    $id = $_GET["id"];

   // lo usamos para borrar
   $base->query("DELETE FROM datos_usuarios WHERE id = '$id'");

   header("Location:crear_leer.php")
  


 ?>