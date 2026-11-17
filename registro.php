<?php
require_once __DIR__ . '/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $dni = trim($_POST['dni'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($nombre) && !empty($dni) && !empty($email) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, dni, email, password, rol, estado) VALUES (:nombre, :dni, :email, :password, 'cliente', 'activo')";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt->execute(['nombre' => $nombre, 'dni' => $dni, 'email' => $email, 'password' => $passwordHash])) {
            header("Location: login.php");
            exit();
        } else {
            $mensaje = "Error al registrar el usuario.";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Crear Cuenta</h1>

        <?php if (!empty($mensaje)): ?>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <form action="registro.php" method="POST">
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
    </main>
</body>
</html>