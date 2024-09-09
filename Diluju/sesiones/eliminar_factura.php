<?php
require '../config/db.php'; // Asegúrate de que la ruta sea correcta para la conexión a la base de datos
// Verificar si se ha pasado el parámetro 'Id_fac' en la URL
if (isset($_GET['Id_fac'])) {
$Id_fac = $_GET['Id_fac'];
try {
// Preparar la consulta para eliminar la factura
$sql = "DELETE FROM factura WHERE Id_fac = :Id_fac";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':Id_fac', $Id_fac, PDO::PARAM_INT);
if ($stmt->execute()) {
echo "Factura eliminada con éxito. <a href='../publico/index_factura.php'>Volver 
a la lista de facturas</a>";
} else {
echo "Error al eliminar la factura. <a href='../publico/index_factura.php'>Volver a 
la lista de facturas</a>";
}
} catch (PDOException $e) {
echo "Error: " . $e->getMessage() . " <a href='../publico/index_factura.php'>Volver 
a la lista de facturas</a>";
}
} else {
echo "ID de factura no proporcionado. <a href='../publico/index_factura.php'>Volver 
a la lista de facturas</a>";
}
 

?> 