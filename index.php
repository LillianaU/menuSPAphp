<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Revista</title>
    <style>
        /* Tus estilos CSS existentes se mantienen igual */
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        Revista de Conocimiento Público
    </div>
    
    <div class="container">
        <!-- Menú Vertical -->
        <div class="sidebar">
            <div class="logo">
                <img src="images/logo-ojs.png" alt="OJS Logo">
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" data-page="envios.php">Envíos</a></li>
                <li><a href="#" data-page="numeros.php">Números</a></li>
                <li><a href="#" data-page="preferencias.php">Preferencias</a></li>
                <li><a href="#" data-page="usuarios.php">Usuarios/as y roles</a></li>
                <li><a href="#" data-page="herramientas.php">Herramientas</a></li>
                <li><a href="#" data-page="administracion.php">Administración</a></li>
                <li><a href="#" data-page="revista.php">Revista</a></li>
                <li><a href="#" data-page="sitio_web.php">Sitio web</a></li>
                <li><a href="#" data-page="flujo_trabajo.php">Flujo de trabajo</a></li>
                <li><a href="#" data-page="distribucion.php">Distribución</a></li>
            </ul>
        </div>

        <!-- Contenido Principal y Menú Horizontal -->
        <div class="content">
            <div class="nav-tabs">
                <a href="#" data-page="secciones.php" class="tab-link active">Secciones de la revista</a>
                <a href="#" data-page="cabecera.php" class="tab-link">Cabecera</a>
                <a href="#" data-page="contacto.php" class="tab-link">Contacto</a>
            </div>

            <div id="content-area" class="content-area">
                <!-- El contenido se cargará aquí -->
            </div>
        </div>
    </div>

    <script>
        function loadPage(page) {
            document.getElementById('content-area').innerHTML = 'Cargando...';
            let url = page.startsWith('pages/') ? page : 'pages/' + page;

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la carga');
                    return response.text();
                })
                .then(data => {
                    document.getElementById('content-area').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('content-area').innerHTML = 
                        '<div style="color: red;">No se pudo cargar la página.</div>';
                });
        }

        // Función para manejar el estado activo
        function setActiveElement(element, isVertical = false) {
            // Remover activos de ambos menús
            document.querySelectorAll('.tab-link, .sidebar-menu a').forEach(item => {
                item.classList.remove('active');
            });
            
            // Agregar activo al elemento clickeado
            element.classList.add('active');
            
            // Scroll suave para menú vertical
            if(isVertical) {
                element.scrollIntoView({behavior: 'smooth', block: 'nearest'});
            }
        }

        // Cargar página inicial
        document.addEventListener('DOMContentLoaded', () => {
            loadPage('secciones.php');
        });

        // Event listeners para menú horizontal
        document.querySelectorAll('.nav-tabs .tab-link').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveElement(this);
                loadPage(this.dataset.page);
            });
        });

        // Event listeners para menú vertical
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveElement(this, true);
                loadPage(this.dataset.page);
            });
        });
    </script>
</body>
</html>