<?php
    // Incluir conexión a la base de datos
    include('./includes/connect.php'); // Asegúrate de tener la conexión incluida
    session_start();
    // Actualizar cantidad

    if(isset($_GET['actualizar_cantidad']) && isset($_GET['accion'])){
        $id_producto = $_GET['actualizar_cantidad'];
        $accion = $_GET['accion'];

        //verificar usuario accesado
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];

            // Obtener la cantidad actual
            $select_query = "SELECT * FROM `carrito_detalles` WHERE id_usuario=$id_usuario AND id_producto=$id_producto";
        } else {
            $ip = getIPAddress();

            // Obtener la cantidad actual usando la dirección IP
            $select_query = "SELECT * FROM `carrito_detalles` WHERE direccion_ip='$ip' AND id_producto=$id_producto";
        }

        // Verificar si el producto ya está en el carrito
        $result_query = mysqli_query($con, $select_query);
        $row = mysqli_fetch_array($result_query);
        $cantidad = $row['cantidad'];
            if(isset($_SESSION['id_usuario'])){
                if($accion == 'aumentar'){
                    $nueva_cantidad = $cantidad + 1;
                    $update_query = "UPDATE carrito_detalles SET cantidad = $nueva_cantidad WHERE id_usuario=$id_usuario AND id_producto=$id_producto";
                    mysqli_query($con, $update_query);
                } elseif($accion == 'disminuir'){
                    // Si la cantidad es mayor a 1, resta una cantidad
                    if($cantidad > 1){
                        $nueva_cantidad = $cantidad - 1;
                        $update_query = "UPDATE carrito_detalles SET cantidad = $nueva_cantidad WHERE id_usuario=$id_usuario AND id_producto=$id_producto";
                        mysqli_query($con, $update_query);
                    } else {
                        // si solo hay una cantidad de un producto eliminar de la base
                        $delete_query = "DELETE FROM carrito_detalles WHERE id_usuario=$id_usuario AND id_producto=$id_producto";
                        mysqli_query($con, $delete_query);
                    }
                }
            }else{
                if($accion == 'aumentar'){
                    $nueva_cantidad = $cantidad + 1;
                    $update_query = "UPDATE carrito_detalles SET cantidad = $nueva_cantidad WHERE direccion_ip='$ip' AND id_producto=$id_producto";
                    mysqli_query($con, $update_query);
                } elseif($accion == 'disminuir'){
                    // Si la cantidad es mayor a 1, resta una cantidad
                    if($cantidad > 1){
                        $nueva_cantidad = $cantidad - 1;
                        $update_query = "UPDATE carrito_detalles SET cantidad = $nueva_cantidad WHERE direccion_ip='$ip' AND id_producto=$id_producto";
                        mysqli_query($con, $update_query);
                    } else {
                        // si solo hay una cantidad de un producto eliminar de la base
                        $delete_query = "DELETE FROM carrito_detalles WHERE direccion_ip='$ip' AND id_producto=$id_producto";
                        mysqli_query($con, $delete_query);
                    }
                }    
            }
            // Redirigir después de actualizar
            header("Location: carrito.php");
            exit();
    }

    // Eliminar producto
    if (isset($_GET['eliminar_producto'])) {
        $id_producto = $_GET['eliminar_producto'];
    
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            // Eliminar usando el id_usuario
            $delete_query = "DELETE FROM `carrito_detalles` WHERE id_usuario = $id_usuario AND id_producto = $id_producto";
        } else {
            $ip = getIPAddress();
            // Eliminar usando la IP
            $delete_query = "DELETE FROM `carrito_detalles` WHERE direccion_ip = '$ip' AND id_producto = $id_producto";
        }
    
        mysqli_query($con, $delete_query);
    
        header("Location: carrito.php");
        exit();
    }
?>
