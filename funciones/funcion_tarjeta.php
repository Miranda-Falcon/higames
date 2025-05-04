<?php
include('../includes/connect.php');
function guardartarjeta() {
    global $con;

    $id_usuario = $_SESSION['id_usuario'];
    $tipo_tarjeta=$_SESSION['metodo_pago'];
    $id_orden=$_SESSION['id_orden'];
    $nombre_titular=$_SESSION['useremail'];

    if($tipo_tarjeta!='tarjeta'){

        // Verificar si ya existe 
        $check_query = "SELECT * FROM detalles_tarjeta 
        WHERE id_orden=$id_orden
        LIMIT 1";
        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // Actualizar 

            $update_query = "UPDATE detalles_tarjeta SET
                    tipo_tarjeta='$tipo_tarjeta',
                    nombre_titular='$nombre_titular',
                    ultimos_4_digitos='XXXX',
                    mes_vencimiento='XX',
                    año_vencimiento='XXXX',
                    fecha_pago=NOW()
                    WHERE id_orden = $id_orden";
            mysqli_query($con, $update_query);
        } else {
            // Crear 
            
            $insert_query = "INSERT INTO detalles_tarjeta 
                    (id_orden, tipo_tarjeta, nombre_titular, ultimos_4_digitos, mes_vencimiento, año_vencimiento,fecha_pago)
                    VALUES ($id_orden, '$tipo_tarjeta', '$nombre_titular', 'XXXX','XX','XXXX',NOW())";
            mysqli_query($con, $insert_query);
        }
    
    }
    
}
?>