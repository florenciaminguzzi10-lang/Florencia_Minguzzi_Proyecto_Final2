<?php
require_once __DIR__ . '/conexion.php';
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = 'UPDATE usuarios SET fecha_archivado = NULL WHERE id = :id';
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['id' => $id]);
}

header('Location: usuarios_archivados.php');
exit;