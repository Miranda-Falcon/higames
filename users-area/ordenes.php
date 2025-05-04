<?php
session_start();
include('../funciones/funcion_tarjeta.php');
if(!isset($_SESSION['useremail'])){
    echo "<script>window.open('../index.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/index.css">

    <title> HIGAMES</title>

</head>
<body>
    <div class="hg-wrapper">
        <div class="hg-header">
            <div class="container">
                <div class="header-menu">
                    <div class="hg-logo">
                        <a href="../index.php">
                            <img src="../img/HIGAMES.png" alt="Logo Higames">
                        </a>
                    </div>
                    <nav class="hg-menu">
                        <ul>
                            <li><a href="../index.php#productos">Productos</a></li>
                            <li><a href="#">Nosotros</a></li>
                            <?php if(isset($_SESSION['useremail'])){ ?>
                            <li><a href="profile.php">Perfil</a></li>
                            <?php } ?> 
                        </ul>

                        <?php
                        if(!isset($_SESSION['useremail'])){//boton login si no ha  iniciado sesion
                        ?>
                        <div class="hg-log">
                            <div class="container">
                                <ul class="hg-login">
                                    <li class="hg-tab">
                                        <a href="../index.php?login_register">Ingresar</a>
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
                                        <a href="cerrar_sesion.php">Cerrar Sesion</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="hg-icon-cart" id="hg-icon-cart">
                            <a href="../carrito.php">
                                <i class="las la-shopping-cart"></i> 
                            </a>
                        </div>
                    </nav>
                </div>                   
            </div>
        </div><!--fin header-->

        <div class="hg-page-block bg-fondo" >
            <div class="container">                
                <!--Metodos de pago-->
                <?php
                      //mostrar forms  
                      // Procesar método de pago seleccionado
                        if (isset($_GET['metodo'])) {
                            $_SESSION['metodo_pago'] = $_GET['metodo']; // Guardar en sesión
                            if($_SESSION['metodo_pago']=='tarjeta' && $_SESSION['tarjeta_validada']==false){                               
                                include('detalles_tarjeta.php'); // Inyectar tarjeta
                            }else{
                                guardartarjeta();
                                include('direccion_envio.php'); // Inyectar dirección de envío
                            }
                            
                        }
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
        <script src="../js/animaciones.js"></script>

        <script>  
            AOS.init({
                duration: 1200,
            });

        </script>
</body>
</html>
