<?php
require '../config/db.php';
$sql = "SELECT * FROM cliente";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Depura los datos para ver la estructura
echo '<pre>';
//print_r($clientes);
echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clientes</title>





<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn-create {
            display: inline-block;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn-create:hover {
            background-color: #218838;
        }
    </style>






</head>
<body>
<h1>Clientes</h1>
<a href="../vistas/crear_clientes.php">Crear Cliente</a>
<table border ="1">
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Dirección</th>
<th>Teléfono</th>
<th>Email</th>
<th>Acciones</th>
</tr>
<?php foreach ($clientes as $cliente): ?>
<tr>
 

<td><?= $cliente['id'] ?></td>
<td><?= $cliente['nombre'] ?></td>
<td><?= $cliente['direccion'] ?></td>
<td><?= $cliente['telefono'] ?></td>
<td><?= $cliente['email'] ?></td>
<td>
<a href="../vistas/clientes_update.php?id=<?= htmlspecialchars($cliente['id']) ?>">Editar</a>
<a href="../sesiones/clientes_eliminar.php?id=<?= htmlspecialchars($cliente['id']) ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
</td>
</tr>
<?php endforeach; 
?>
</table>
</body>
</html>