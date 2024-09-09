<?php
include('config/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
if (!empty($email) && !empty($password)) {
// Preparar la consulta SQL
$stmt = $pdo->prepare("INSERT INTO usuario (email, password) VALUES 
(:email, :password)");
if ($stmt->execute(['email' => $email, 'password' => $password])) {
header("Location: login_registro.php");
exit();
} else {
$error = "Error al registrar el usuario.";
}
} else {
$error = "Por favor, complete todos los campos.";
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrarse</title>
 

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
rel="stylesheet">
<style>
body {
background-color: #f8f9fa;
}
.container {
max-width: 400px;
margin-top: 50px;
padding: 20px;
background: white;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
border-radius: 10px;
}
</style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="container">
<h2 class="text-center">Registrarse</h2>
<?php if (isset($error)): ?>
<div class="alert alert-danger" id="error-alert">
<?php echo $error; ?>
</div>
<?php endif; ?>
<form action="login_registro.php" method="post">
<div class="form-group">
<label for="email" class="form-label">Correo Electrónico</label>
<input type="email" class="form-control" id="email" name="email" 
required>
</div>
<div class="form-group">
<label for="password" class="form-label">Contraseña</label>
<input type="password" class="form-control" id="password" 
name="password" required>
</div>
<button type="submit" class="btn btn-primary btn-block">Registrarse</button>
</form>
<p class="text-center mt-3">
<a href="login.php">Iniciar Sesión</a>
</p>
</div>
<?php include('includes/footer.php'); ?>
 

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script 
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
></script>
<script>
$(document).ready(function() {
$("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
$(this).slideUp(500);
});
});
</script>
</body>
</html>