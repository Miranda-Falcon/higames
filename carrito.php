<?php
include('./funciones/funciones_comunes.php');
include('./funciones/actualizar_cantidades.php');
include('./funciones/orden_funcion.php'); 
$_SESSION['tarjeta_validada'] = false; // Marcar como completado

gestionarOrdenBorrador();
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
    <link rel="stylesheet" href="css/tabla.css">

    
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
        </div><!--fin header-->

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
                        <h1>Carrito de Compras</h1>
                    </div>
                    <?php
                        //quitar-poner mensaje carro vacio
                        $contador_carrito = obtener_total_carrito();
                        if ($contador_carrito == 0) {
                    ?>
                    <!-- TABS -->
                    <p id="carrito-vacio">No hay articulos en el carrito :( <br>
                        <a href="index.php#productos">Empieza a agregar algunos</a><br>
                        <img src="img/carrovacio.png" width="50px" height="50px">
                    </p>
                    <?php
                        }else{
                    ?>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Nombre Producto</th>
                                        <th>Imagen Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        global $con;
                                        $precio_total=0;

                                        //verificar si esta autenticado
                                        if(isset($_SESSION['id_usuario'])){//productos asociados al id_usuario
                                            $id_usuario=$_SESSION['id_usuario'];
                                            $carrito_query="SELECT * FROM `carrito_detalles` where id_usuario=$id_usuario";
                                        }else{//si no por la ip
                                            $ip=getIPAddress();
                                            $carrito_query="SELECT * FROM `carrito_detalles` where direccion_ip='$ip'";
                                        }

                                        //obtener productos en el carrito
                                        $result=mysqli_query($con,$carrito_query);

                                        while($row=mysqli_fetch_array($result)){
                                            $id_producto=$row['id_producto'];
                                            $select_productos="SELECT * FROM `productos` where id_producto=$id_producto";
                                            $result_productos=mysqli_query($con,$select_productos);

                                            while($row_productos_precio=mysqli_fetch_array($result_productos)){
                                                //en caso de estar en oferta
                                                if($row_productos_precio['en_oferta']){
                                                    $precio_producto=$row_productos_precio['precio_nuevo'];
                                                }else{
                                                    $precio_producto=$row_productos_precio['precio'];
                                                }
                                                $nombre_producto=$row_productos_precio['nombre_producto'];
                                                $imagen=$row_productos_precio['imagen'];
                                                $cantidad=$row['cantidad'];
                                                $subtotal=$precio_producto*$cantidad;
                                                $precio_total+=$precio_producto;
                                    ?>

                                    <tr>
                                        <td><?php echo $nombre_producto; ?></td>
                                        <td><img src="./admin-area/imagen_productos/<?php echo $imagen; ?>" alt=""></td>
                                        <td>$<?php echo number_format($precio_producto, 2); ?></td>
                                        <td><a href="carrito.php?actualizar_cantidad=<?php echo $id_producto; ?>&accion=disminuir" class="hg-btn btn-primary uppercase" style="padding: 5px 10px;">
                                                <i class="fa-solid fa-circle-minus"></i>
                                            </a>   
                                            <?php echo $cantidad; ?>   
                                            <a href="carrito.php?actualizar_cantidad=<?php echo $id_producto; ?>&accion=aumentar" class="hg-btn btn-primary uppercase" style="padding: 5px 10px;">
                                                <i class="fa-solid fa-circle-plus"></i>
                                            </a>
                                        </td>
                                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                                        <td>
                                            <a href="carrito.php?eliminar_producto=<?php echo $id_producto; ?>" class="hg-btn btn-primary uppercase">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div><br>
                                <h3>
                                    <span>TOTAL: $    <?php precio_total_carrito();?></span>
                                </h3>
                                <div class="">
                                    <br><a href="checkout.php" class='hg-btn btn-primary uppercase'>Finalizar Compra</a>
                                </div>
                            </div>        
                    <?php
                        }//quitar-poner mensaje carro vacio
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
            const welcomeElement = document.getElementById('carrito-vacio');
            if (welcomeElement) {
                welcomeElement.style.display = 'none';
            }
        }
    </script>
</body>
</html>