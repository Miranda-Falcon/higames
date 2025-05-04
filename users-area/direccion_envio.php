<?php

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
    <link rel="stylesheet" href="../css/estilosinicio.css">
    <link rel="stylesheet" href="../css/login_register.css">
    <link rel="stylesheet" href="../css/select.css">
    <link rel="stylesheet" href="../css/index.css">

    <title> HIGAMES</title>

</head>
<body>
    <div class="hg-wrapper">
        <div class="hg-sign">
            <div class="container">
                <p id="admin-welcome" style="text-align: center; font-weight: 600; font-size: 30px">Dirección de Envio</p>
                    <form action="" method="POST" id="direccion_envio_form">
                            <input type="text" id="nombre_recibe" name="nombre_recibe" placeholder="Nombre de quien recibe " autocomplete=off required/>
                            <input type="text" id="telefono_recibe" name="telefono_recibe" placeholder="Numero de telefono" autocomplete=off required/>

                            <div style="display: flex; gap: 20px;">
                            <input type="text" id="pais" name="pais" placeholder="Pais" autocomplete=off required/>
                            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Codigo postal" autocomplete=off required/>
                            <input type="text" id="estado" name="estado" placeholder="Estado" autocomplete=off required/>
                            <input type="text" id="municipio" name="municipio" placeholder="municipio" autocomplete=off required/>
                            <input type="text" id="localidad" name="localidad" placeholder="localidad" autocomplete=off required/>
                                
                            </div>
                            <input type="text" id="direccion" name="direccion" placeholder="Direccion completa (calle,numero ext, localidad,etc)" autocomplete=off required/>

                            <input type="submit" name="direccion_register" value="Registrarse" class="" style="background: #04530E;"/>

                            <img src="../img/dragonite_cartero.jpg">
                    </form>
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
            })
        </script>
        
</body>
</html>

<?php 
if(isset($_POST['direccion_register'])){
    $_SESSION['tarjeta_validada'] = false; // Marcar como completado

    $id_orden=$_SESSION['id_orden'];
    $nombre_recibe = $_POST['nombre_recibe'];
    $telefono_recibe = $_POST['telefono_recibe'];
    $pais = $_POST['pais'];
    $codigo_postal = $_POST['codigo_postal'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $id_usuario = $_SESSION['id_usuario'];

    //validaciones  
    if (
        empty($nombre_recibe) || empty($telefono_recibe) || empty($pais) ||
        empty($codigo_postal) || empty($estado) || empty($municipio) ||
        empty($localidad) || empty($direccion)
    ) {
        $errors[] = 'Llena todos los campos';
    }

    // Validar teléfono: exactamente 10 dígitos numéricos
    if (!preg_match('/^\d{10}$/', $telefono_recibe)) {
        $errors[] = 'El teléfono debe tener exactamente 10 dígitos numéricos';
    }

    // Validar código postal: exactamente 5 dígitos numéricos
    if (!preg_match('/^\d{5}$/', $codigo_postal)) {
        $errors[] = 'El código postal debe tener exactamente 5 dígitos numéricos';
    }

    if(empty($errors)) {
        
        // Verificar si ya existe 
        $check_query = "SELECT * FROM user_orders 
        WHERE id_orden=$id_orden and status_orden='borrador'
        LIMIT 1";
        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // finalizar compra 

            //registrar direccion
            $insert_query = "INSERT INTO direccion_envio 
            (id_orden, nombre_recibe, telefono_recibe, pais, codigo_postal,estado,municipio,localidad,direccion)
            VALUES ($id_orden, '$nombre_recibe', '$telefono_recibe', '$pais', '$codigo_postal', '$estado','$municipio', '$localidad', '$direccion')";
            mysqli_query($con, $insert_query);

            //orden pendiente
            $update_query = "UPDATE user_orders SET
                    status_orden='pendiente'
                    WHERE id_orden = $id_orden and id_usuario=$id_usuario and status_orden='borrador'
                    ";
            mysqli_query($con, $update_query);

            //vaciar carrito
            $delete_query = "DELETE FROM `carrito_detalles` WHERE id_usuario = $id_usuario";
            mysqli_query($con,$delete_query);
            echo "<script>alert('Compra finalizada');</script>";
            echo "<script>window.open('profile.php','_self')</script>";
        }
    }


}
?>

