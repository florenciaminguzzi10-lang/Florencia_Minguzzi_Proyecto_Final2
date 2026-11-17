<?php
session_start();
require_once __DIR__ . '/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, nombre, dni, email, rol FROM usuarios WHERE estado = 'activo'";
$stmt = $conexion->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Gestión de Usuarios</h1>
        <nav>
            <a href="usuarios_archivados.php">Ver Usuarios Archivados</a>
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </nav>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($u['dni'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['rol']); ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $u['id']; ?>">Editar</a>
                        <a href="archivar_usuario.php?id=<?php echo $u['id']; ?>">Archivar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>