<?php
session_start();
require_once __DIR__ . '/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "UPDATE usuarios SET estado = 'activo' WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['id' => $id]);
}

header("Location: usuarios_archivados.php");
exit();
?>