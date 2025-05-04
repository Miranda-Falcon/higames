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
    
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="hg-wrapper">
        <div class="hg-header">      
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
                                </ul>    
                            </div>
                        </div>

                    </nav>
            </div>                         
        </div>
        

        <!-- PRODUCTOS  -->


            <div class="hg-page-block bg-fondo" >
                <div class="container">

                    <div class="header-title" data-aos="fade-up">
                        <h1>ADMIN DASHBOARD</h1>
                    </div>
    
                    <!-- TABS -->
                    <p id="admin-welcome" style="text-align: center; font-weight: 600; font-size: 30px"><i>Bienvenido</i>
                        <i>admin_name</i><br>
                        <img src="../img/link_saludo.png" style="width: 70%; height: 70%;">
                    </p>

                </div>
            </div>

            <div class="container">
                <?php
                    if(isset($_GET['agregar_produc'])){
                        include('agregar_productos.php');
                    }
                ?>
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
                            <li><a href="#">Productos</a></li>
                            <li><a href="#">Campañas</a></li>
                            <li><a href="#">Nosotros</a></li>
                            <li><a href="#">Contacto</a></li>
                            <li><a href="#">Preventas</a></li>
                            <li><a href="#">Redes Sociales</a></li>
                            <li><a href="#">Ofertas</a></li>
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