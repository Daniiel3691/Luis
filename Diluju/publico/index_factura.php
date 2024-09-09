<?php
require '../config/db.php';

// Consulta para obtener todas las facturas
$sql = "SELECT f.Id_fac, f.fec_fac, c.Id, c.nombre AS nom_cli, s.nom_ser, f.Valor_Total
        FROM factura f
        JOIN cliente c ON f.Id = c.Id
        JOIN servicios s ON f.Id_ser = s.Id_ser";
$stmt = $pdo->query($sql);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Facturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }

        .btn-create {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-create:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions a {
            margin-right: 10px;
            color: #007bff;
            transition: color 0.3s;
        }

        .actions a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Lista de Facturas</h1>
<a href="../vistas/crear_factura.php" class="btn-create">Crear Nueva Factura</a>

<table>
    <tr>
        <th>ID Factura</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Servicios</th>
        <th>Valor Total</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($resultado as $fila): ?>
        <tr>
            <td><?= htmlspecialchars($fila['Id_fac']); ?></td>
            <td><?= htmlspecialchars($fila['fec_fac']); ?></td>
            <td><?= htmlspecialchars($fila['nom_cli']); ?></td>
            <td><?= htmlspecialchars($fila['nom_ser']); ?></td>
            <td><?= htmlspecialchars($fila['Valor_Total']); ?>€</td>
            <td class="actions">
                <a href="../vistas/factura_update.php?id=<?= htmlspecialchars($fila['Id_fac']); ?>">Editar</a> |
                <a href="../sesiones/eliminar_factura.php?Id_fac=<?= htmlspecialchars($fila['Id_fac']); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>