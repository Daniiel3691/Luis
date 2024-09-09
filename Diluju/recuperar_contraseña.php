<?php
include('config/db.php');
$error = '';
$success = '';
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$new_password = password_hash($_POST['password'], 
PASSWORD_BCRYPT);
if (!empty($email) && !empty($new_password)) {
// Verificar si el correo electrónico existe
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
$stmt->execute(['email' => $email]); 
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
// Actualizar la contraseña
$stmt = $pdo->prepare("UPDATE usuario SET password = :password 
WHERE email = :email");
if ($stmt->execute(['password' => $new_password, 'email' => $email])) {
$success = "Contraseña actualizada correctamente.";
} else {
$error = "Error al actualizar la contraseña.";
}
} else {
$error = "El correo electrónico no existe.";
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
<title>Recuperar Contraseña</title>
<link 
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
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
<h2 class="text-center">Recuperar Contraseña</h2>
<?php if (!empty($error)): ?>
<div class="alert alert-danger" id="error-alert">
<?php echo $error; ?>
</div>
<?php endif; ?>
<?php if (!empty($success)): ?>
<div class="alert alert-success" id="success-alert">
<?php echo $success; ?>
</div>
<?php endif; ?>
<form action="recuperar_contraseña.php" method="post">
<div class="form-group">
<label for="email" class="form-label">Correo Electrónico</label>
<input type="email" class="form-control" id="email" name="email" 
required>
</div>
<div class="form-group">
<label for="password" class="form-label">Nueva Contraseña</label>
<input type="password" class="form-control" id="password" 
name="password" required>
</div>
<button type="submit" class="btn btn-primary btn-block">Actualizar 
Contraseña</button>
</form>
<p class="text-center mt-3">
<a href="login.php">Iniciar Sesión</a>
</p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script 
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
></script>
<script>
$(document).ready(function() {
$("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
 
11
$(this).slideUp(500);
});
$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
$(this).slideUp(500);
});
});
</script>
<?php include('includes/footer.php'); ?>
</body>
</html>