<?php
function gestionarOrdenBorrador() {
    global $con;
    
    if (!isset($_SESSION['id_usuario'])) {
        return; // No hacer nada si no hay usuario logueado
    }

    $id_usuario = $_SESSION['id_usuario'];
    $total_productos = obtener_total_carrito();
    $precio_total = precio_total();

    // Verificar si ya existe una orden en borrador
    $check_query = "SELECT * FROM user_orders 
                    WHERE id_usuario = $id_usuario AND status_orden = 'borrador' 
                    LIMIT 1";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Actualizar orden existente
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_orden'] = $row['id_orden']; // Guardar ID en sesión

        $num_factura = 'FAC-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));        
        $update_query = "UPDATE user_orders SET
                        monto = $precio_total,
                        num_factura='$num_factura',
                        total_productos = $total_productos,
                        fecha_orden = NOW()
                        WHERE id_usuario = $id_usuario 
                        AND status_orden = 'borrador'";
        mysqli_query($con, $update_query);
    } else {
        // Crear nueva orden borrador
        $num_factura = 'FAC-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));        
        $insert_query = "INSERT INTO user_orders 
                        (id_usuario, monto, num_factura, total_productos, fecha_orden, status_orden)
                        VALUES ($id_usuario, $precio_total, '$num_factura', $total_productos, NOW(), 'borrador')";
        mysqli_query($con, $insert_query);
        $_SESSION['id_orden'] = mysqli_insert_id($con); // Guardar ID en sesión
    }
    
}

function precio_total(){
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
    return $precio_total;
}
?>