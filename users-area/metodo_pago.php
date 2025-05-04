<?php
    include('./includes/connect.php');

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
        <div class="hg-page-block bg-fondo" >
            <div class="container">                
                <!--Metodos de pago-->
                <div id="metodos_pago" class="hg-grid-category">
                    <!--Enviar a perfil con orden pendiente-->
                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="users-area/ordenes.php?metodo=paypal">
                            <img src="../img/paypal.jpg" alt="">
                            <div class="c-info">
                                <h3>PayPal</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="1500">
                        <a href="users-area/ordenes.php?metodo=mercado_pago">
                            <img src="../img/mercado_pago.jpg" alt="">
                            <div class="c-info">
                                <h3>Mercado Pago</h3>
                            </div>
                        </a>
                    </div>

                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="users-area/ordenes.php?metodo=google_pay">
                            <img src="../img/google_pay.jpg" alt="">
                            <div class="c-info">
                                <h3>Google Pay</h3>
                            </div>
                        </a>
                    </div>    
                    <!--Enviar a perfil con orden pendiente-->


                    <!--Inyectar detalles_tarjeta.php-->
                    <div class="grid-item" data-aos="fade-up" data-aos-duration="2000">
                        <a href="users-area/ordenes.php?metodo=tarjeta" id="pago_tarjeta">
                            <img src="../img/visa.jpg" alt="">
                            <div class="c-info">
                                <h3>TARJETA</h3>
                            </div>
                        </a>
                    </div>
                </div> 
                <!--Fin Metodos de pago-->
                <div id="detalles_tarjeta" style="display: none;"></div>

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
