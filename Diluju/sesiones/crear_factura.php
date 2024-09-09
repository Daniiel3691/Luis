<?php
require '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Obtener los valores del formulario
$fec_fac = $_POST['fec_fac'];
$Id = $_POST['Id']; // Este es el ID del cliente, corregido para usar 'Id'
$Id_ser = $_POST['Id_ser'];
$Valor_Total = $_POST['Valor_Total'];
// Remover el símbolo de moneda para que el valor sea numérico
$Valor_Total = str_replace('€', '', $Valor_Total);
try {
// Obtener el valor del servicio desde la tabla servicios
$stmt = $pdo->prepare("SELECT Valor_ser FROM servicios WHERE Id_ser =
:Id_ser");
$stmt->execute([':Id_ser' => $Id_ser]);
$servicio = $stmt->fetch(PDO::FETCH_ASSOC);
if ($servicio) {
$Valor_ser = $servicio['Valor_ser'];
 

// Insertar la nueva factura en la base de datos
$sql = "INSERT INTO factura (fec_fac, Id_ser, Valor_ser, Valor_Total, Id) 
VALUES (:fec_fac, :Id_ser, :Valor_ser, :Valor_Total, :Id)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
':fec_fac' => $fec_fac,
':Id' => $Id, // Corregido para usar $Id en lugar de $Id_con
':Id_ser' => $Id_ser,
':Valor_ser' => $Valor_ser, 
':Valor_Total' => $Valor_Total
]);
// Redirigir al usuario a la página de éxito o a la lista de facturas
header("Location: ../publico/index_factura.php");
exit();
} else {
echo "Error: El servicio seleccionado no existe.";
}
} catch (PDOException $e) {
echo "Error al crear la factura: " . $e->getMessage();
}
}
?>