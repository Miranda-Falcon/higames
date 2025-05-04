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
                <p id="admin-welcome" style="text-align: center; font-weight: 600; font-size: 30px">Detalles tarjeta</p>
                    <form  id="form_tarjeta" method="POST" <?php echo (isset($_SESSION['tarjeta_validada']) && $_SESSION['tarjeta_validada']) ?>>
                            <input type="text" id="nombre_titular" name="nombre_titular" placeholder="Nombre del titular de la tarjeta" autocomplete=off required/>
                            <input type="text" id="num_tarjeta" name="num_tarjeta" placeholder="Numero de la Tarjeta" autocomplete=off required/>

                            <div style="display: flex; gap: 50px;">
                                <select class="custom-select" name="mes_vencimiento" id="mes_vencimiento" required>
                                    <option value="">Mes</option>
                                    <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                    <option value="4">4</option><option value="5">5</option><option value="6">6</option>
                                    <option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                    <option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                </select>
                                <select class="custom-select" name="año_vencimiento" id="año_vencimiento" required>
                                    <option value="">Año</option>
                                    <option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option>
                                    <option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option>
                                    <option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option>
                                    <option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option>
                                </select>
                            <input type="text" id="cvv" name="cvv" placeholder="CVV" autocomplete=off required/>
                            </div>

                            <input type="submit" name="tarjeta_register" value="Siguiente" class="" style="background: #04530E;"/>

                            <img src="../img/naruto_monedero.jpg">
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

    if(isset($_POST['tarjeta_register'])){
        
        $id_orden=$_SESSION['id_orden'];
        $tipo_tarjeta=$_SESSION['metodo_pago'];
        $nombre_titular = $_POST['nombre_titular'];
        $num_tarjeta = $_POST['num_tarjeta'];
        $ultimos_4_digitos = substr($num_tarjeta, -4);
        $mes_vencimiento = $_POST['mes_vencimiento'];
        $año_vencimiento = $_POST['año_vencimiento'];
        $cvv = $_POST['cvv'];
        $errors = [];

        //validaciones
         
        if(!preg_match('/^\d{16}$/', $_POST['num_tarjeta'])) {
            $errors[] = 'Número de tarjeta inválido';
        }

        // Validación mes
        if ($mes_vencimiento < 1 || $mes_vencimiento > 12) {
            $errors[] = 'Mes invalido';
        }

        // Validación vencimiento
        $año_actual = date("Y");
        $mes_actual = date("n");

        if ($año_vencimiento < $año_actual || ($año_vencimiento == $año_actual && $mes_vencimiento < $mes_actual)) {
            $errors[] = 'Tarjeta vencida';
        }

        // Validación CVV
        if (!preg_match('/^\d{3}$/', $cvv)) {
            $errors[] = 'CVV invalido';
        }


        if(empty($errors)) {
            // Guardar datos en sesión
            $_SESSION['tarjeta_validada'] = true; // Marcar como completado
            
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
                        ultimos_4_digitos='$ultimos_4_digitos',
                        mes_vencimiento='$mes_vencimiento',
                        año_vencimiento='$año_vencimiento',
                        fecha_pago=NOW()
                        WHERE id_orden = $id_orden
                        ";
                mysqli_query($con, $update_query);
            } else {
                // Crear 

                $insert_query = "INSERT INTO detalles_tarjeta 
                        (id_orden, tipo_tarjeta, nombre_titular, ultimos_4_digitos, mes_vencimiento, año_vencimiento,fecha_pago)
                        VALUES ($id_orden, '$tipo_tarjeta', '$nombre_titular', '$ultimos_4_digitos', '$mes_vencimiento', '$año_vencimiento',NOW())";
                mysqli_query($con, $insert_query);
            }


            echo "<script>alert('tarjeta validada.');
            location.reload();
            </script>";

        } else {
            $_SESSION['tarjeta_validada'] = false; // Marcar como completado
            $error_text = implode("\\n", $errors); // \\n es salto de línea en JavaScript
            // Mostrar errores
            echo "<script>alert('$error_text');
            </script>";
        }
    }//fin isset tarjeta_register
?>

