<?php
require '../config/db.php';
// Recoge los datos del formulario
$id = $_POST['id']; // Usando 'id' en minúscula en el formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
// Consulta SQL para insertar datos
$sql = "INSERT INTO cliente (id, nombre, telefono, direccion, email) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $nombre, $telefono, $direccion, $email]);
// Redirige a la página de lista de clientes
 

header("Location: ../publico/index.php");
exit();
?>