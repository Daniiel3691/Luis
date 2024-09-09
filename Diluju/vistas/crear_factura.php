<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Nueva Factura</title>



<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
            position: absolute;
             top: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
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
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"]:read-only {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>








<script>
function calcularValorTotal() {
var servicioSeleccionado = document.getElementById('Id_ser');
var valorSer =
servicioSeleccionado.options[servicioSeleccionado.selectedIndex].getAttribute('data-valor');
document.getElementById('Valor_Total').value = valorSer ? valorSer : '';
document.getElementById('Valor_ser').value = valorSer ? valorSer : ''; //Actualizar el campo oculto Valor_ser
}
</script>
</head>
<body>
<h1>Crear Nueva Factura</h1>
<form action="../sesiones/crear_factura.php" method="post">
<label for="fec_fac">Fecha de Factura:</label>
<input type="date" id="fec_fac" name="fec_fac" required><br><br>
<label for="Id">Cliente:</label>
<select id="Id" name="Id" required>
<?php
require '../config/db.php';
try {
$stmt = $pdo->query("SELECT Id, nombre FROM cliente");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($clientes as $cliente) {
echo "<option value='" . $cliente['Id'] . "'>" . $cliente['nombre'] . "</option>";
}
} catch (PDOException $e) {
echo "Error al obtener los clientes: " . $e->getMessage();
}
?>
</select><br><br>
<label for="Id_ser">Servicio:</label>
<select id="Id_ser" name="Id_ser" required onchange="calcularValorTotal()">
<option value="">Seleccione un servicio</option>
<!-- Opciones adicionales manuales -->
 <!--   <option value="1" data-valor="200000">Comprar</option>
    <option value="2" data-valor="200000">General factura</option>
    <option value="3" data-valor="200000">Cambios</option>-->
<?php
 

try {
$stmt = $pdo->query("SELECT Id_ser, nom_ser, Valor_ser FROM servicios");
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($servicios as $servicio) {
echo "<option value='" . $servicio['Id_ser'] . "' data-valor='" .
$servicio['Valor_ser'] . "'>" . $servicio['nom_ser'] . " - " . $servicio['Valor_ser'] .
"€</option>";
}
} catch (PDOException $e) {
echo "Error al obtener los servicios: " . $e->getMessage();
}
?>
</select><br><br>
<!-- Campo oculto para almacenar el valor del servicio seleccionado -->
<input type="hidden" id="Valor_ser" name="Valor_ser">
<label for="Valor_Total">Valor Total:</label>
<input type="text" id="Valor_Total" name="Valor_Total" readonly><br><br>
<button type="submit">Crear Factura</button>
</form>
</body>
</html>