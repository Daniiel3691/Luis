<?php
// decalarar las variables que 
$host = 'localhost'; // nombre del servidor
$dbname = 'tienda.onet'; // nombre de la base de datos
$username = 'root'; // cual es su usuario para ingresar a su base de datos en Xampp
$password = 'gomezquintana'; // cual es su contraseña al ingresar a la base de datos en Xampp
try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", 
$username, $password); //establece una conexión a la base de datos usando los parámetros definidos anteriormente.
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Error al conectar a la base de datos: " . $e->getMessage()); //imprime el mensaje por pantalla
}
?>