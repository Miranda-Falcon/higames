<?php
include('./funciones/funciones_comunes.php');
session_start();
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
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/index.css">
    
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7453a9e31c.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="hg-wrapper">
        
        <div class="hg-header">
            <div class="container">
                <div class="header-menu">
                    <div class="hg-logo">
                        <a href="index.php">
                            <img src="img/HIGAMES.png" alt="Logo Higames">
                        </a>
                    </div>
                    <nav class="hg-menu">
                        <ul>
                            <li><a href="index.php#productos">Productos</a></li>
                            <li><a href="#">Nosotros</a></li>
                            <?php if(isset($_SESSION['useremail'])){ ?>
                            <li><a href="users-area/profile.php">Perfil</a></li>
                            <?php } ?> 
                        </ul>

                        <?php
                        if(!isset($_SESSION['useremail'])){//boton login si no ha  iniciado sesion
                        ?>
                        <div class="hg-log">
                            <div class="container">
                                <ul class="hg-login">
                                    <li class="hg-tab">
                                        <a href="index.php?login_register">Ingresar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }else{//boton para cerrar sesion si esta logeado
                        ?>
                        <div class="hg-log">
                            <div class="container">
                                <ul class="hg-login">
                                    <li class="hg-tab">
                                        <a href="users-area/cerrar_sesion.php">Cerrar Sesion</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        carrito();
                        ?>

                        <div class="hg-icon-cart" id="hg-icon-cart">
                            <a href="carrito.php">
                                <i class="las la-shopping-cart"></i>
                                <span>
                                    <?php
                                        item_carrito();
                                    ?>
                                </span>
                            </a>
                        </div>

                        

                    </nav>
                </div>                   
            </div>
        </div>
        
        <?php
            //quitar-poner login
            if(isset($_GET['login_register'])){
                include('users-area/login_register.php');
            }else{
        ?>
        <!-- PRODUCTOS  -->

            <div class="hg-page-block bg-fondo" >
                <div class="container"> 
                    <div class="header-title" data-aos="fade-up">
                        <h1>CHECKOUT</h1>
                    </div>
                    <?php
                        if(!isset($_SESSION['useremail'])){
                            include('users-area/login_register.php');
                        }else{
                            include('users-area/metodo_pago.php');
                        }
                    ?>

                </div>
            </div>
            <?php
                }//quitar-poner login
            ?>
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
                            <li><a href="index.php#productos">Productos</a></li>
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
</body>
</html>