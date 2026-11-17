<?php
session_start();
require_once __DIR__ . '/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin_usuarios.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $dni = trim($_POST['dni']);
    $email = trim($_POST['email']);
    $rol = $_POST['rol'];

    $sql = "UPDATE usuarios SET nombre = :nombre, dni = :dni, email = :email, rol = :rol WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['nombre' => $nombre, 'dni' => $dni, 'email' => $email, 'rol' => $rol, 'id' => $id]);

    header("Location: admin_usuarios.php");
    exit();
}

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Editar Usuario</h1>
        <form action="editar_usuario.php?id=<?php echo $id; ?>" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($usuario['dni']); ?>" required>

            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label for="rol">Rol</label>
            <select id="rol" name="rol">
                <option value="cliente" <?php echo ($usuario['rol'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="admin" <?php echo ($usuario['rol'] === 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select>

            <button type="submit">Guardar Cambios</button>
        </form>
        <a href="admin_usuarios.php">Cancelar</a>
    </main>
</body>
</html>