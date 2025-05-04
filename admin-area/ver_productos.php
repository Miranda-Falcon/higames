<?php
session_start();
include('../includes/connect.php'); 
if(!isset($_SESSION['user_admin'])){
    echo "<script>window.open('admin_login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HIGAMES</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/index.css">
    
    <script src="../js/cartService.js" defer></script>
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>

    <style>
        .tabla-usuarios {
            margin: 0 auto; /* Centra la tabla */
            border-collapse: collapse;
            width: 90%;
            max-width: 1000px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .tabla-usuarios th, .tabla-usuarios td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }

        .tabla-usuarios th {
            background-color: #f0f0f0;
            font-weight: 600;
        }

        .tabla-usuarios td img {
            width: 60px;
            height: 60px;
            object-fit: cover;

        }
        .producto-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px; /* Opcional, si quieres esquinas redondeadas */
        }
</style>
</head>
<body>

    <div class="hg-wrapper">
        
        <div class="header-menu">
                    <div class="hg-logo">
                        <a href="index.php">
                            <img src="../img/HIGAMES.png" alt="Logo Higames">
                        </a>
                    </div>
                    <nav class="hg-menu">
                        <ul>
                            <li><a href="index.php?agregar_produc">Agregar_Productos</a></li>
                            <li><a href="ver_productos.php">Ver_Productos</a></li>
                            <li><a href="#">Ordenes pendientes</a></li>
                            <li><a href="#">Ordenes completadas</a></li>
                            <li><a href="ver_usuarios.php">Usuarios</a></li>
                        </ul>

                        <div class="hg-log">
                            <div class="container">
                                <ul class="hg-login">
                                    <li class="hg-tab">
                                        <a href="cerrar_admin.php">Cerrar Sesion</a>
                                    </li>
                            </div>
                        </div>

                    </nav>
                                   
            
        </div>
        

        <!-- PRODUCTOS  -->

        <div class="hg-page-block bg-fondo">
            <div class="container">
                <div class="header-title" data-aos="fade-up">
                    <h1>ADMIN DASHBOARD</h1>
                </div>

                <!-- TABS -->

                <?php
                    echo '<h1>Productos</h1>';
                    $conn = mysqli_connect('db', 'root', 'root123');
                    $database = mysqli_select_db($conn, 'db_carrito');
                    $query = "SELECT * FROM productos";
                    $result = mysqli_query($conn, $query);

                    echo '<table class="tabla-usuarios">';
                    echo '<thead><tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Keywords</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>En oferta</th>
                        <th>Precio de oferta</th>
                        <th>Fecha</th>
                    </tr></thead>';

                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['id_producto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nombre_producto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['palabras_clave']) . '</td>';

                        // Mostrar imagen
                        echo '<td><img class="producto-img" src="imagen_productos/' . htmlspecialchars($row['imagen']) . '" alt="Imagen"></td>';

                        echo '<td>$' . htmlspecialchars($row['precio']) . '</td>';

                        // Mostrar true/false en "en_oferta"
                        echo '<td>' . ($row['en_oferta'] ? 'true' : 'false') . '</td>';

                        // Mostrar precio de oferta
                        echo '<td>' . ($row['precio_nuevo'] ? '$' . htmlspecialchars($row['precio_nuevo']) : '-') . '</td>';

                        echo '<td>' . htmlspecialchars($row['date']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                    $result->close();
                    mysqli_close($conn);
                ?>
            </div>
        </div>

        <!-- FOOTER  -->
        <footer>
            
            <div class="container">

                <div class="foo-row">
                    <div class="foo-col">
                        <h2>Suscríbete <br>a nuestra revista</h2>
                        <form action="" method="GET">

                            <div class="f-input">
                                <input type="text" placeholder="Ingrese su correo">
                                <button type="submit" class="hg-btn-round btn-primary"><i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>

                    </div>

                    <div class="foo-col">
                        <ul>
                            <li><a href="Index.html#productos">Productos</a></li>
                            <li><a href="http://">Campañas</a></li>
                            <li><a href="http://">Nosotros</a></li>
                            <li><a href="http://">Contacto</a></li>
                            <li><a href="preventas.html">Preventas</a></li>
                            <li><a href="http://">Redes Sociales</a></li>
                            <li><a href="http://">Ofertas</a></li>
                        </ul>
                    </div>

                </div>

            </div>

        </footer>

        <div class="foo-copy">
            <div class="container">
                <p>HIGS STORE 2024 © Todos los derechos reservados</p>
            </div>
        </div>

    </div>
    
    <!-- Animaciones-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Script -->
    <script src="js/animaciones.js"></script>

    <script>
    
        AOS.init({
            duration: 1200,
        })


    </script>

    <script>//ocultar imagen de bienvenida
        // Verifica si el parámetro 'agregar_produc' está en la URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('agregar_produc')) {
            const welcomeElement = document.getElementById('admin-welcome');
            if (welcomeElement) {
                welcomeElement.style.display = 'none';
            }
        }
    </script>
</body>
</html>