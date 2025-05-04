<?php
    include('./includes/connect.php'); // Asegúrate de que esta conexión funcione bien
    
    function obtener_videojuegos(){
        global $con;
        $select_query = "SELECT * FROM `productos` WHERE categoria = 'videojuego' AND en_oferta = false";
        $result_query=mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $categoria=$row['categoria'];
            $imagen=$row['imagen'];
            $precio=$row['precio'];
            echo "    
            <div class='product-item'>   
                <div class='p-portada'>
                        <img src='./admin-area/imagen_productos/$imagen' alt='$nombre_producto'> 
                </div>
                <div class='p-info'>
                    <h3>$nombre_producto</h3>
                    <div class='precio'>
                        <span>$$precio</span>
                    </div>
                    <a href='index.php?agregar_carrito=$id_producto' class='hg-btn btn-primary uppercase'>AGREGAR AL CARRITO</a>
                </div>
            </div>
            ";
        }   

    }
    function obtener_consolas(){
        global $con;
        $select_query = "SELECT * FROM `productos` WHERE categoria = 'consola' AND en_oferta = false";
        $result_query=mysqli_query($con,$select_query);

        while($row=mysqli_fetch_assoc($result_query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $categoria=$row['categoria'];
            $imagen=$row['imagen'];
            $precio=$row['precio'];

            echo "    
            <div class='product-item'>   
                <div class='p-portada'> 
                        <img src='./admin-area/imagen_productos/$imagen' alt='$nombre_producto'>       
                </div>
                <div class='p-info'>
                    <h3>$nombre_producto</h3>
                    <div class='precio'>
                        <span>$$precio</span>
                    </div>
                    <a href='index.php?agregar_carrito=$id_producto' class='hg-btn btn-primary uppercase'>AGREGAR AL CARRITO</a>
                </div>
            </div>
            ";
        }
    }
    function obtener_accesorios(){
        global $con;
        $select_query = "SELECT * FROM `productos` WHERE categoria = 'accesorio' AND en_oferta = false";
        $result_query=mysqli_query($con,$select_query);

        while($row=mysqli_fetch_assoc($result_query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $categoria=$row['categoria'];
            $imagen=$row['imagen'];
            $precio=$row['precio'];

            echo "    
            <div class='product-item'>   
                <div class='p-portada'>
                        <img src='./admin-area/imagen_productos/$imagen' alt='$nombre_producto'>
                </div>
                <div class='p-info'>
                    <h3>$nombre_producto</h3>
                    <div class='precio'>
                        <span>$$precio</span>
                    </div>
                    <a href='index.php?agregar_carrito=$id_producto' class='hg-btn btn-primary uppercase'>AGREGAR AL CARRITO</a>
                </div>
            </div>
            ";
        }
    }
    function obtener_ofertas(){
        global $con;
        $select_query = "SELECT * FROM `productos` WHERE en_oferta = true";
        $result_query=mysqli_query($con,$select_query);

        while($row=mysqli_fetch_assoc($result_query)){
            $id_producto=$row['id_producto'];
            $nombre_producto=$row['nombre_producto'];
            $categoria=$row['categoria'];
            $imagen=$row['imagen'];
            $precio=$row['precio'];
            $precio_nuevo=$row['precio_nuevo'];

            echo "
                <div class='product-item'>    
                    <div class='p-portada'>
                        <img src='admin-area/imagen_productos/$imagen' alt='$nombre_producto'>                              
                        <span class='stin stin-oferta'>Oferta</span>
                    </div>
                    <div class='p-info'>
                        <h3>$nombre_producto</h3>
                        <div class='precio'>
                        <span>$$precio_nuevo</span>
                        <span class='thash'>$$precio</span>
                    </div>
                    <a href='index.php?agregar_carrito=$id_producto' class='hg-btn btn-primary uppercase'>AGREGAR AL CARRITO</a>
                    </div>
                </div>
            ";
        }
    }

    //obtener ip address para guardar el carrito temporalmente ligado a la ip
    function getIPAddress(){
        //si la ip es de internet compartida
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        //si la ip es de un proxy
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //si la ip es de una direccion remota
        else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
//$ip=getIPAddress();
//echo 'user ip: '.$ip;

    //funcion de carrito
    function carrito(){
        if(isset($_GET['agregar_carrito'])){
            global $con;
            $get_id_producto=$_GET['agregar_carrito'];
            $ip = getIPAddress();

            if (isset($_SESSION['id_usuario'])) {
                $id_usuario = $_SESSION['id_usuario'];
                $select_query = "SELECT * FROM `carrito_detalles` WHERE id_usuario = $id_usuario AND id_producto = $get_id_producto";
            } else {

                $select_query = "SELECT * FROM `carrito_detalles` WHERE direccion_ip = '$ip' AND id_producto = $get_id_producto";
            }

            $result_query=mysqli_query($con,$select_query);
            $num_filas=mysqli_num_rows($result_query);

            //si el producto esta en el carrito aumentar en 1
            if($num_filas>0){

                if (isset($_SESSION['id_usuario'])) {
                    $update_query = "UPDATE `carrito_detalles` SET cantidad = cantidad + 1 WHERE id_usuario = $id_usuario AND id_producto = $get_id_producto";
                } else {
                    $update_query = "UPDATE `carrito_detalles` SET cantidad = cantidad + 1 WHERE direccion_ip = '$ip' AND id_producto = $get_id_producto";
                }
                mysqli_query($con, $update_query);
                echo "<script>alert('Se aumentó en 1 el producto')</script>";

            }else{
                //si el producto no esta en el carrito
                if (isset($_SESSION['id_usuario'])) {
                    $insert_query = "INSERT INTO `carrito_detalles` (id_producto, id_usuario, cantidad) VALUES ($get_id_producto, $id_usuario, 1)";
                } else {
                    $insert_query = "INSERT INTO `carrito_detalles` (id_producto, direccion_ip, cantidad) VALUES ($get_id_producto, '$ip', 1)";
                }
                mysqli_query($con, $insert_query);
                echo "<script>alert('Articulo agregado al carrito correctamente')</script>";
            }
            //redirigir a la pagina principal
            echo "<script>window.open('index.php','_self')</script>";        
        }
    }

    //funcion contar y poner numero en el carrito
    function item_carrito(){
        global $con;

        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $select_query = "SELECT * FROM `carrito_detalles` WHERE id_usuario = $id_usuario";
        } else {
            $ip = getIPAddress();
            $select_query = "SELECT * FROM `carrito_detalles` WHERE direccion_ip = '$ip'";
        }
    
        $result_query = mysqli_query($con, $select_query);
        $contador_carrito = 0;
        while ($row = mysqli_fetch_array($result_query)) {
            $contador_carrito += $row['cantidad'];
        }

        echo $contador_carrito;
    }

    //para usar el numero como variable
    function obtener_total_carrito(){
        global $con;

        if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        $select_query = "SELECT * FROM `carrito_detalles` WHERE id_usuario = $id_usuario";
        } else {
            $ip = getIPAddress();
            $select_query = "SELECT * FROM `carrito_detalles` WHERE direccion_ip = '$ip'";
        }

        $result_query = mysqli_query($con, $select_query);
        $total = 0;
        while ($row = mysqli_fetch_array($result_query)) {
            $total += $row['cantidad'];
        }
        return $total;
    }    

    //precio total
    function precio_total_carrito(){
        global $con;
        
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $carrito_query = "SELECT * FROM `carrito_detalles` WHERE id_usuario = $id_usuario";
        } else {
            $ip = getIPAddress();
            $carrito_query = "SELECT * FROM `carrito_detalles` WHERE direccion_ip = '$ip'";
        }
    
        $result = mysqli_query($con, $carrito_query);
        $precio_total = 0;
    
        while ($row = mysqli_fetch_array($result)) {
            $id_producto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            $select_productos = "SELECT * FROM `productos` WHERE id_producto = $id_producto";
            $result_productos = mysqli_query($con, $select_productos);
    
            while ($row_productos_precio = mysqli_fetch_array($result_productos)) {
                if ($row_productos_precio['en_oferta']) {
                    $precio_producto = $row_productos_precio['precio_nuevo'];
                } else {
                    $precio_producto = $row_productos_precio['precio'];
                }
                $precio_total += $precio_producto * $cantidad;
            }
        }
        echo $precio_total;
    }

    //en caso de tener items como anonimo y se inicia sesion
    function migrar_carrito_a_usuario($id_usuario){
        global $con;
        $ip = getIPAddress();
    
        // Obtener los productos en el carrito por IP
        $query_ip = "SELECT * FROM `carrito_detalles` WHERE direccion_ip = '$ip'";
        $result_ip = mysqli_query($con, $query_ip);
    
        while ($row = mysqli_fetch_assoc($result_ip)) {
            $id_producto = $row['id_producto'];
            $cantidad_ip = $row['cantidad'];
    
            // Verificar si el producto ya está en el carrito del usuario
            $query_usuario = "SELECT * FROM `carrito_detalles` WHERE id_usuario = $id_usuario AND id_producto = $id_producto";
            $result_usuario = mysqli_query($con, $query_usuario);
    
            if (mysqli_num_rows($result_usuario) > 0) {
                // Si existe, aumentar la cantidad
                $update_query = "UPDATE `carrito_detalles` SET cantidad = cantidad + $cantidad_ip WHERE id_usuario = $id_usuario AND id_producto = $id_producto";
                mysqli_query($con, $update_query);
            } else {
                // Si no existe, insertar y asociar al usuario
                $insert_query = "INSERT INTO `carrito_detalles` (id_producto, id_usuario, cantidad) VALUES ($id_producto, $id_usuario, $cantidad_ip)";
                mysqli_query($con, $insert_query);
            }
    
            // Eliminar entrada por IP
            $delete_query = "DELETE FROM `carrito_detalles` WHERE direccion_ip = '$ip' AND id_producto = $id_producto";
            mysqli_query($con, $delete_query);
        }
    }
?>