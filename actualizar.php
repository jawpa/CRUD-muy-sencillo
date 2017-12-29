<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="hojas.css">
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 

include 'conexion.php';


// para no confundir con la info recibida luego del submit, este condicional no necesario:
// si el botón no está definido,no lo leerá la primera vez
if (!isset($_POST['bot_actualizar'])) {
	$id = $_GET["id"];
	$nombre = $_GET["nombre"];
	$direccion = $_GET["direccion"]; 
	$apellido = $_GET["apellido"];
}else{
    // ponemos la captura de los valores que envía está misma página antes, porque al apretar submit se recarga
    $id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$direccion = $_POST["direccion"]; 
	$apellido = $_POST["apellido"];

    // protegemos la entrada de datos de la inyección sql con marcadores
	$sql = 'UPDATE datos_usuarios SET nombre=:nombre,apellido=:apellido,direccion=:direccion WHERE id=:id';

    // creamos la consulta preparada
    $resultado = $base->prepare($sql);

    // ejecutamos el array asignando los parámetros a la consulta sql
    $resultado->execute(array(":id"=>$id,":nombre"=>$nombre,":apellido"=>$apellido,":direccion"=>$direccion));

    // vamos a esta página, leará los datos actualizados
    header("Location:crear_leer.php");
}

 ?>

 <h1>ACTUALIZAR</h1>

<p>
 
</p>
<p>&nbsp;</p>
<!-- enviamos la info del formulario a esta misma página -->
<!-- usando el método post, no podemos usar get porque en la url se sobreescribirían valores -->
<!-- ya que antes usamos get y al hacer submit, la página se recarga -->
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
  <table width="25%" border="0" align="center">
    <tr>
      <td></td>
      <td><label for="id"></label>
      <!-- ponemos los valores recibidos en la propiedad value para editarlos -->
      <input type="hidden" name="id" id="id" value="<?php echo $id ?>"></td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td><label for="nom"></label>
      <input type="text" name="nombre" id="nom" value="<?php echo $nombre ?>"></td>
    </tr>
    <tr>
      <td>Apellido</td>
      <td><label for="ape"></label>
      <input type="text" name="apellido" id="ape" value="<?php echo $apellido ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="direccion" id="dir" value="<?php echo $direccion ?>"></td>
    </tr>
    <tr>
    <!-- dónde enviamos el submit? -->
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>

</body>
</html>


