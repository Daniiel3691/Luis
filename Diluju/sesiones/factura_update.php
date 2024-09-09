<?php
require '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Obtener los datos del formulario
$Id_fac = $_POST['Id_fac'];
$fec_fac = $_POST['fec_fac'];
// Asegúrate de que este nombre coincida con el formulario HTML
$Id_ser = $_POST['Id_ser'];
$Valor_Total = $_POST['Valor_Total'];
$Id = $_POST['Id'];
try {
// Actualizar la factura en la base de datos
 

$sql = "UPDATE factura SET fec_fac = :fec_fac, Id_ser = :Id_ser, Valor_Total = :Valor_Total, Id = :Id WHERE Id_fac = :Id_fac";
$stmt = $pdo->prepare($sql);
$stmt->execute([
':fec_fac' => $fec_fac,
':Id_ser' => $Id_ser,
':Valor_Total' => $Valor_Total,
':Id_fac' => $Id_fac, // Faltaba una coma aquí
':Id' => $Id,
]);
// Redirigir después de la actualización exitosa
header("Location: ../publico/index_factura.php");
exit();
} catch (PDOException $e) {
echo "Error al actualizar la factura: " . $e->getMessage();
exit();
}
}
?>