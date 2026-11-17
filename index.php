<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudio Luna - Barbería y Catálogo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Estudio Luna</h1>
        <nav>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php if ($_SESSION['usuario_rol'] === 'admin'): ?>
                    <a href="admin_usuarios.php">Panel Admin</a>
                <?php else: ?>
                    <a href="panel.php">Mi Panel</a>
                <?php endif; ?>
                <a href="cerrar_sesion.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar Sesión</a>
                <a href="registro.php">Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section>
            <h2>Bienvenidos a Estudio Luna</h2>
            <p>Tu barbería de confianza. Descubre nuestros servicios y gestiona tu cuenta de forma rápida.</p>
            
            <?php if (!isset($_SESSION['usuario_id'])): ?>
                <a href="registro.php">Crear Cuenta</a>
                <a href="login.php">Ingresar</a>
            <?php endif; ?>
        </section>

        <section>
            <h2>Catálogo de Cortes y Servicios</h2>
            
            <div>
                
                <img src="img/corte1.jpg" alt="Corte Clásico" width="250">
                <h3>Corte Clásico</h3>
                <p>Estilo tradicional, prolijo y elegante para el día a día.</p>
            </div>

            <div>
              
                <img src="img/corte2.jpg" alt="Corte Moderno" width="250">
                <h3>Corte Moderno / en capas</h3>
                <p>En capas, moderno y corto.</p>
            </div>

            <div>
                
                <img src="img/corte3.jpg" alt="Corte y Barba" width="250">
                <h3>Corte y Barba</h3>
                <p>Servicio completo de mantenimiento y perfilado de barba.</p>
            </div>
        </section>

        <section>
            <h2>Próximamente</h2>
            <p>Muy pronto habilitaremos la sección para que puedas reservar turnos online y consultar tu historial de visitas.</p>
        </section>

        <section>
            <h2>Promociones y Ofertas</h2>
            <p>Entérate de los beneficios exclusivos, descuentos por cumpleaños y promos para clientes registrados en la barbería.</p>
        </section>
    </main>

    <footer>
        <p>Estudio Luna - 2026</p>
    </footer>

</body>
</html>