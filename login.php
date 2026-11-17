<?php
session_start();
require_once __DIR__ . '/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && ($password === $usuario['password'] || password_verify($password, $usuario['password']))) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol'] = $usuario['rol'];

            if ($usuario['rol'] === 'admin') {
                header("Location: admin_usuarios.php");
                exit();
            } else {
                header("Location: panel.php");
                exit();
            }
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <img src="img/barberia.jpg.jpeg" alt="Logo Estudio Luna" width="900">
        <h1>Iniciar Sesión</h1>
         


        <?php if (!empty($error)): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate</a>
    </main>
</body>
</html>