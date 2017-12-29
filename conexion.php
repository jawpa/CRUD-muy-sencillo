<?php 
try {

    // nos conectamos a la base
	$base = new PDO('mysql:host=localhost; dbname=pruebas','root','1234');

    // gestionamos las excepciones
	$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // escribimos en cristiano
	$base->exec('SET CHARACTER SET utf8');
	
} catch (Exception $e) {
	die('Error' . $e->getMessage());
    echo "Línea del Error" . $e->getLine();

}


 ?>