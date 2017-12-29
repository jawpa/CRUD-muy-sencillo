<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="hoja.css">
	<meta charset="UTF-8">
	<title>CRUD</title>
</head>
<body>

<?php 
   include 'conexion.php';

   if (isset($_POST["cr"])) {
   	   $nombre = $_POST["nombre"];
   	   $apellido = $_POST["apellido"];
   	   $direccion = $_POST["direccion"];

   	   $sql = "INSERT INTO datos_usuarios (nombre,apellido,direccion) VALUES (:nombre,:apellido,:direccion)";

   	   $resultado = $base->prepare($sql);

   	   $resultado->execute(array(":nombre"=>$nombre,":apellido"=>$apellido,":direccion"=>$direccion)); 

   	    header("Location:crear_leer.php");
   }
   

   $registros_paginas = 3;

   if (isset($_GET['pagina'])) {
              
        if ($_GET['pagina'] == 1){
         
            header("Location:crear_leer.php");
        
        }else{

            $pagina = $_GET['pagina'];

        }

            
    }else{
    
        $pagina = 1;

    }

    $empezar_desde = ($pagina - 1) * $registros_paginas;
    
    $conexion = $base->query("SELECT * FROM datos_usuarios");

    $num_registros = $conexion->rowCount();
    
    $total_paginas = ceil($num_registros/$registros_paginas);

    
    
    $conexion2 = $base->query("SELECT * FROM datos_usuarios LIMIT $empezar_desde,$registros_paginas");


    $registros = $conexion2->fetchAll(PDO::FETCH_OBJ);  

    

   ?>

 <form action="<?php echo($_SERVER['PHP_SELF'])?>" method="post">		
	<table width="50%" border="0" align="center">
		<tr>
			<td class="primera_fila">ID</td>
			<td class="primera_fila">Nombre</td>
			<td class="primera_fila">Apellido</td>
			<td class="primera_fila">Dirección</td>
			<td class="sin">&nbsp;</td>
			<td class="sin">&nbsp;</td>
			<td class="sin">&nbsp;</td>
		</tr>

        <?php 
              
              foreach ($registros as $persona) :?> 
              	          
          
		<tr>
		    
			<td><?php echo($persona->id) ?></td>     
			<td><?php echo($persona->nombre) ?></td>
			<td><?php echo($persona->apellido) ?></td>
			<td><?php echo($persona->direccion) ?></td>

           
			<td class="bot"><a href="borrar.php?id=<?php echo($persona->id) ?>"><input type="button" name="del" id="del" value="Borrar"></a></td>
			<td class="bot"><a href="actualizar.php?id=<?php echo($persona->id) ?> & nombre=<?php echo($persona->nombre) ?> & apellido=<?php echo($persona->apellido) ?> & direccion=<?php echo($persona->direccion) ?>"><input type="button" name="up" id="up" value="Actualizar"></a> 
			</td>
		</tr>

		<?php
		     
		    endforeach;
           
		 ?>

		<tr>
		    <td></td>
			<td><input type="text" name="nombre" size="10" class="centrado"></td>
            <td><input type="text" name="apellido" size="10" class="centrado"></td>
            <td><input type="text" name="direccion" size="10" class="centrado"></td>
            <td class="bot"><input type="submit" name="cr" name="cr" ></td>
        </tr>
        <tr>
        	<td colspan="4"><?php 
	      
			        for ($i=1; $i <= $total_paginas; $i++) { 
			            
			           echo "<a href='?pagina=". $i ."'>  " . $i ."</a>  ";
			        
			        }
			    ?>
	 	    </td>
        </tr>
	</table>
</form>	

	<p>&nbsp;</p>
	
	
</body>
</html>