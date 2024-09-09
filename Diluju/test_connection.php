<?php
include('config/db.php');// llamar base de datos
try {
$stmt = $pdo->query("SELECT * FROM usuario");//consulta sql tabla usuarios
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Conexión exitosa. La tabla 'usuarios' contiene los siguientes 
registros:<br>";
foreach ($usuarios as $usuario) {
echo " - Email: " . $usuario['email'] . "<br>";
echo " - Password: " . $usuario['password'] . "<br>"; // Mostrar contraseña
}
} catch (PDOException $e) {
echo "Error: " . $e->getMessage(); //mensajes de error
}
?>
