<!DOCTYPE html
>
<html lang
=
"es
"
>
<head
>
<meta charset
=
"UTF
-
8
"
>
 

<title>Editar Factura</title>






<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="date"],
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>










<script>
function calcularValorTotal() {
var servicioSeleccionado = document.getElementById('Id_ser');
var valorSer =
servicioSeleccionado.options[servicioSeleccionado.selectedIndex].getAttribute('data-valor');
document.getElementById('Valor_Total').value = valorSer ? valorSer + '€' : '';
}
</script>
</head>
<body>
<h1>Editar Factura</h1>
<?php
// Aquí debe estar definida la variable $factura antes de renderizar el formulario
require '../config/db.php';
// Verifica que se haya recibido un Id_fac y carga la factura
if (isset($_GET['id'])) {
$Id_fac = $_GET['id'];
try {
$stmt = $pdo->prepare("SELECT * FROM factura WHERE Id_fac = :Id_fac");
$stmt->execute([':Id_fac' => $Id_fac]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$factura) {
echo "No se encontró la factura con el ID proporcionado.";
exit();
}
} catch (PDOException $e) {
echo "Error al obtener la factura: " . $e->getMessage();
exit();
}
} else {
echo "ID de factura no proporcionado.";
exit();
}
?>
<form action="../sesiones/factura_update.php" method="post">
<input type="hidden" name="Id_fac" value="<?php echo $factura['Id_fac']; ?>">
 

<label for="fec_fac">Fecha de Factura:</label>
<input type="date" id="fec_fac" name="fec_fac" value="<?php echo
$factura['fec_fac']; ?>" required><br><br>
<label for="Id">Cliente:</label>
<select id="Id" name="Id" required>
<?php
try {
$stmt = $pdo->query("SELECT Id, nombre FROM cliente");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($clientes as $cliente) {
$selected = $cliente['Id'] == $factura['Id'] ? 'selected' : '';
echo "<option value='" . $cliente['Id'] . "' $selected>" . $cliente['nombre'] .
"</option>";
}
} catch (PDOException $e) {
echo "Error al obtener los clientes: " . $e->getMessage();
}
?>
</select><br><br>
<label for="Id_ser">Servicio:</label>
<select id="Id_ser" name="Id_ser" required onchange="calcularValorTotal()">
<option value="">Seleccione un servicio</option>
<?php
try {
$stmt = $pdo->query("SELECT Id_ser, nom_ser, Valor_ser FROM servicios");
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($servicios as $servicio) {
$selected = $servicio['Id_ser'] == $factura['Id_ser'] ? 'selected' : '';
echo "<option value='" . $servicio['Id_ser'] . "' data-valor='" .
$servicio['Valor_ser'] . "' $selected>" . $servicio['nom_ser'] . " - " . $servicio['Valor_ser'] 
. "€</option>";
}
} catch (PDOException $e) {
echo "Error al obtener los servicios: " . $e->getMessage();
}
?>
</select><br><br>
<label for="Valor_Total">Valor Total:</label>
 

<input type="text" id="Valor_Total" name="Valor_Total" value="<?php echo
$factura['Valor_Total']; ?>" readonly><br><br>
<button type="submit">Guardar Cambios</button>
</form>
</body>
</html>