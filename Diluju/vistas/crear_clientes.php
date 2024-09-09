<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Cliente</title>



<style>

        h1 {
             text-align: justify;
             color: #333;
             position: absolute;
             top: 20px;
        }


      

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
       
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
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
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>





</head>
<body>
<h1>Crear Cliente</h1>
<form action="../sesiones/crear_clientes.php" method="post">
<!-- "../sesiones/crear_clientes.php"-->
<label for="Id">Cédula:</label>
<input type="text" id="id" name="id" required>
<br>
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" required>
<br>
<label for="direccion">Dirección:</label>
<input type="text" id="direccion" name="direccion" required>
<br>
<label for="telefono">Teléfono:</label>
<input type="text" id="telefono" name="telefono" required>
<br>
 

<label for="email">Email:</label>
<input type="email" id="email" name="email" required>
<br>
<button type="submit">Enviar</button>
</form>
</form>
</body>
</html>