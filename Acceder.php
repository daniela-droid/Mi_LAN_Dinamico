<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Conexión a la base de datos
$conn = new mysqli("localhost", "paola", "dani321", "Login");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];

    // Evitar inyecciones SQL (básico)
    $usuario = $conn->real_escape_string($usuario);
    $pass = $conn->real_escape_string($pass);

    // Consulta SQL para verificar usuario y contraseña
    $sql = "SELECT * FROM sesion WHERE usuario='$usuario' AND pass='$pass'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        // Inicio de sesión exitoso
        header("Location: index.html");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!-- Formulario HTML dentro del mismo login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <!-- Mostrar error si lo hay -->
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="pass">Contraseña:</label><br>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="submit" value="Ingresar">
    </form>
</body>
</html>

