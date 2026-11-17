<?php
session_start();
require_once __DIR__ . '/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, nombre, dni, email FROM usuarios WHERE estado != 'activo'";
$stmt = $conexion->query($sql);
$archivados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Archivados - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Usuarios Archivados</h1>
        <a href="admin_usuarios.php">Volver al panel principal</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Correo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($archivados) > 0): ?>
                    <?php foreach ($archivados as $a): ?>
                    <tr>
                        <td><?php echo $a['id']; ?></td>
                        <td><?php echo htmlspecialchars($a['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($a['dni'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($a['email']); ?></td>
                        <td>
                            <a href="restaurar.php?id=<?php echo $a['id']; ?>">Restaurar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay usuarios archivados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>