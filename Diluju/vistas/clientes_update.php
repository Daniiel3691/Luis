<?php
require '../config/db.php';
echo '<pre>';
print_r($_GET);
echo '</pre>';
if (!isset($_GET['id']) || empty($_GET['id'])) {
die('Id del cliente no proporcionado');
}
$id = $_GET['id'];
echo "Id recibido: " . htmlspecialchars($id); // Depuración para ver el ID recibido
$sql = "SELECT * FROM cliente WHERE Id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$cliente) {
die('Cliente no encontrado');
}
?>



<!DOCTYPE html>
<html>
 

<head>
<title>Editar Cliente</title>


<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: absolute;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>




</head>
<body>
<h1>Editar Cliente</h1>
<form action="../sesiones/clientes_update.php" method="post">
<input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>"> 
<!-- Nombre del campo oculto debe coincidir con el ID -->
<label for="id">Cédula:</label>
<input type="text" id="id" name="id" value="<?= htmlspecialchars($cliente['id']) 
?>" required> <!-- Asegúrate de usar el nombre correcto del campo -->
<br>
<label for="nombre">Nombre:</label>
<input type="text" name="nombre" id="nombre" value="<?= 
htmlspecialchars($cliente['nombre']) ?>" required>
<br>
<label for="direccion">Dirección:</label>
<input type="text" name="direccion" id="direccion" value="<?= 
htmlspecialchars($cliente['direccion']) ?>" required>
<br>
<label for="telefono">Teléfono:</label>
<input type="text" name="telefono" id="telefono" value="<?= 
htmlspecialchars($cliente['telefono']) ?>" required>
<br>
<label for="email">Email:</label>
<input type="email" name="email" id="email" value="<?= 
htmlspecialchars($cliente['email']) ?>" required>
<br>
<input type="submit" value="Actualizar">
</form>
</body>
</html>