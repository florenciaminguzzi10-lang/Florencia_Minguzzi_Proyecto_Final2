<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Panel - Estudio Luna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <section>
            <h1>Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h1>
            <p>Bienvenido a tu panel de cliente en Estudio Luna.</p>
        </section>

        <section>
            <div>
                <h3>Nuestros Cortes</h3>
                <p>Explora los estilos clásicos y modernos disponibles en la barbería.</p>
                <a href="index.php">Ver Catálogo</a>
            </div>
            <div>
                <h3>Mis Turnos</h3>
                <p>Consulta el historial o el estado de tus reservas pendientes.</p>
                <a href="index.php">Próximamente</a>
            </div>
            <div>
                <h3>Promociones</h3>
                <p>Entérate de los beneficios exclusivos para clientes registrados.</p>
                <a href="index.php">Ver Ofertas</a>
            </div>
        </section>

        <nav>
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </nav>
    </main>
</body>
</html>