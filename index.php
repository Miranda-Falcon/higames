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

</head>
<body>
<? //var_dump($_SESSION)?>
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
                            <li><a href="#productos">Productos</a></li>
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

                        <div class="hg-icon-cart" id="hg-icon-cart">
                                <span>TOTAL:$<?php precio_total_carrito();?></span>
                        </div>  
                    </nav>
                </div>                   
            </div>
        </div><!--fin header-->

        <?php
            //quitar-poner login
            if(isset($_GET['login_register'])){
                include('users-area/login_register.php');
            }else{
        ?>
        <div class="hg-ley">
            <div class="container">
                <p><i>La Mejor Tienda de </i></p>
                <p><i>VideoJuegos de México</i></p>
            </div>
        </div>

        <!-- CAROUSEL-->
        <div class="carrousel">
            <div class="conteCarrousel">
                <div class="itemCarrousel" id="itemCarrousel-1">
                    <img src ="img/Logitech.jpg" alt="itemCarrousel-1"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-6">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-2">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="itemCarrousel" id="itemCarrousel-2">
                    <img src ="img/MarioDay.jpg" alt="itemCarrousel-2"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-1">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-3">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="itemCarrousel" id="itemCarrousel-3">
                    <img src ="img/FinalFantasyRebirth.jpg" alt="itemCarrousel-3"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-2">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-4">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="itemCarrousel" id="itemCarrousel-4">
                    <img src ="img/EA_Spring2_mvk-2048x700.jpg" alt="itemCarrousel-4"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-3">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-5">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="itemCarrousel" id="itemCarrousel-5">
                    <img src ="img/Multiclubes.jpg" alt="itemCarrousel-5"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-4">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-6">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="itemCarrousel" id="itemCarrousel-6">
                    <img src ="img/DemonSlayer.jpg" alt="itemCarrousel-6"/>
                    <div class="itemCarrouselTarjeta"></div>
                    <div class="itemCarrouselArrows">
                        <a href="#itemCarrousel-5">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#itemCarrousel-1">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="conteCarrouselController">
                <a href="#itemCarrousel-1"></a>
                <a href="#itemCarrousel-2"></a>
                <a href="#itemCarrousel-3"></a>
                <a href="#itemCarrousel-4"></a>
                <a href="#itemCarrousel-5"></a>
                <a href="#itemCarrousel-6"></a>
            </div>
        </div>

        <!-- Marcas -->
        <div class="hg-page-block">
            <div class="container">
                <div class="header-title">
                    <h1  data-aos="fade-up" data-aos-duration="2000">Marcas</h1>
                </div>

                <div class="hg-grid-category">

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="#">
                            <img src="img/Xbox1.jpg" alt="">
                            <div class="c-info">
                                <h3>Xbox</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1500">
                        <a href="#">
                            <img src="img/PlayStation.jpg" alt="">
                            <div class="c-info">
                                <h3>PlayStation</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="#">
                            <img src="img/Nintendo.jpg" alt="">
                            <div class="c-info">
                                <h3>Nintendo</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="#">
                            <img src="img/Razer.jpg" alt="">
                            <div class="c-info">
                                <h3>Razer</h3>
                            </div>
                        </a>
                    </div>                  
                </div>
            </div>
        </div>


        <!-- PRODUCTOS  -->
            <div class="hg-page-block bg-fondo" id="productos">
                <div class="container">
                    <div class="header-title" data-aos="fade-up">
                        <h1>Productos </h1>
                    </div>

                    <!-- TABS -->
                    <ul class="hg-tabs" data-aos="fade-up">
                        <li class="hg-tab-link" data-target="videogames">VideoJuegos</li>
                        <li class="hg-tab-link" data-target="console">Consolas</li>
                        <li class="hg-tab-link" data-target="accesory">Accesorios</li>
                        <li class="hg-tab-link ative" data-target="offer">En oferta</li>
                    </ul>

                    <!-- CONTENIDO DE LOS TABS -->
                    <!-- Videjuegos -->
                    <div class="tabs-content" data-aos="fade-up">
                        <section id="productos-">
                            <?php
                                obtener_videojuegos();
                            ?>
                        </section>               
                    </div>

                    <!-- Consolas -->            
                    <div id="console" class="tabs-content" data-aos="fade-up">
                        <section id="productos-">
                            <?php
                                obtener_consolas();
                            ?>
                        </section>               
                    </div>

                    <!-- Accesorios -->
                    <div class="tabs-content" data-aos="fade-up">  
                        <section id="productos-">
                            <?php
                                obtener_accesorios();
                            ?>
                        </section>               
                    </div>

                    <!-- En oferta -->
                    <div id="offer" class="tabs-content" data-aos="fade-up" >
                        <section id="productos-">
                            <?php
                                obtener_ofertas();
                            ?>
                        </section>               
                    </div>
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
                <p>HIGS STORE 2025 © Todos los derechos reservados</p>
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