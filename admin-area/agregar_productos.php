<?php
include('../includes/connect.php'); // Asegúrate de que esta conexión funcione bien

if(isset($_POST['agregar_produc'])){

    $nombre_producto=$_POST['nombre'];
    $palabras_clave=$_POST['palabras_clave'];
    $categoria=$_POST['categoria'];
    $precio=$_POST['precio'];
    $en_oferta=$_POST['en_oferta'];
    
    if ($en_oferta == '1') {
        $precio_nuevo = $_POST['precio_nuevo'];
    } else {
        $precio_nuevo = null;
    }

    $status='true';

    $imagen=$_FILES['imagen']['name'];
    $tmp_imagen=$_FILES['imagen']['tmp_name'];

    //condicion vacio
    if($nombre_producto=='' || $palabras_clave=='' || $categoria=='' || 
    $precio=='' || $en_oferta=='' || $imagen==''){
        echo "<script>alert('llena todos los campos')</script>";
        exit();
    }
    
    //formato de imagen
    $ext=strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        echo "<script>alert('Formato de imagen inválido. Solo se permiten JPG, JPEG o PNG.')</script>";
        exit();
    }

    //precio oferta menor al original
    if ($en_oferta == '1' && $precio_nuevo >= $precio) {
        echo "<script>alert('El precio en oferta debe ser menor al precio original.')</script>";
        exit();
    }

    // Producto duplicado
    $check_query = "SELECT * FROM productos WHERE nombre_producto = '$nombre_producto'";
    $result_check = mysqli_query($con, $check_query);
    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Ya existe un producto con ese nombre.')</script>";
        exit();
    }

    // Renombrar imagen de forma única
    $unique_name = time() . '_' . basename($imagen);
    $upload_path = "./imagen_productos/$unique_name";
    if (!move_uploaded_file($tmp_imagen, $upload_path)) {
        echo "<script>alert('Error al subir la imagen.')</script>";
        exit();
    }

    
        // Insertar en BD
    $precio_nuevo_sql = ($precio_nuevo !== null) ? "'$precio_nuevo'" : "NULL";

    $agregar_produc = "INSERT INTO `productos` 
        (nombre_producto, palabras_clave, categoria, imagen, precio, en_oferta, precio_nuevo, date, status) 
        VALUES 
        ('$nombre_producto', '$palabras_clave', '$categoria', '$unique_name', '$precio', '$en_oferta', $precio_nuevo_sql, NOW(), '$status')";

    $result_query = mysqli_query($con, $agregar_produc);

    if ($result_query) {
        echo "<script>alert('Datos insertados correctamente.')</script>";
    } else {
        $error_msg = mysqli_error($con);
    $error_msg_escaped = addslashes($error_msg); // Escapar comillas para JavaScript
    echo "<script>alert('Error al insertar en la base de datos: $error_msg_escaped');</script>";
    }
    
}
?>

<p style="font-size: 24px; font-weight: 600; text-align: center;">
    <i>Agregar productos</i>
</p>

<form action="" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
    
    <label for="nombre">Nombre del producto:</label>
    <input type="text" name="nombre" id="nombre" required autocomplete=off>

    <label for="palabras_clave">Palabras clave:</label>
    <input type="text" name="palabras_clave" id="palabras_clave" required autocomplete=off>

    <label for="categoria">Categoría:</label>
    <select name="categoria" id="categoria" required>
        <option value="">Seleccionar...</option>
        <option value="videojuego">Videojuego</option>
        <option value="consola">Consola</option>
        <option value="accesorio">Accesorio</option>
    </select>

    <label for="imagen">Imagen del producto:</label>
    <input type="file" name="imagen" id="imagen" accept="image/*" required>

    <label for="precio">Precio original:</label>
    <input type="number" step="0.01" name="precio" id="precio" required autocomplete=off>

    <label for="en_oferta">¿En oferta?</label>
    <select name="en_oferta" id="en_oferta" onchange="togglePrecioNuevo()" required autocomplete=off>
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select>

    <div id="precio-nuevo-container" style="display: none;">
        <label for="precio_nuevo">Precio en oferta:</label>
        <input type="number" step="0.01" name="precio_nuevo" id="precio_nuevo" autocomplete=off>
    </div>

    <input type="submit" name="agregar_produc" style="padding: 10px 20px; background: #004aad; color: white; border: none; cursor: pointer;" value="agregar productos">

    <br><br>
</form>

<script>
    function togglePrecioNuevo() {
        const enOferta = document.getElementById('en_oferta').value;
        const container = document.getElementById('precio-nuevo-container');
        container.style.display = enOferta === "1" ? "block" : "none";
    }
</script>
