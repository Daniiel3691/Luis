<?php
require '../config/db.php';
// Validar que los datos del formulario estén presentes
if (!isset($_POST['id']) || !isset($_POST['nombre']) || !isset($_POST['direccion']) || 
!isset($_POST['telefono']) || !isset($_POST['email'])) {
die('Datos del formulario incompletos.');
}
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$sql = "UPDATE cliente SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE 
Id = ?";
$stmt = $pdo->prepare($sql);
try {
$stmt->execute([$nombre, $direccion, $telefono, $email, $id]);
header("Location: ../publico/index.php");
exit();
} catch (PDOException $e) {
echo 'Error: ' . $e->getMessage();
 

}
?>