<?php
    include('./includes/connect.php');
    @session_start();
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
    <link rel="stylesheet" href="../css/estilosinicio.css">
    <link rel="stylesheet" href="../css/login_register.css">

    <title> HIGAMES</title>

</head>
<body>
    <div class="hg-wrapper">
        <div class="hg-sign">
            <div class="container" id="container">

                <!-- user_register-->
                <div class="form-container sign-up">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h1>Crea una Cuenta</h1>
                            <input type="text" id="user_name" name="user_name" placeholder="Nombre" autocomplete=off required/>
                            <input type="email" id="user_email" name="user_email" placeholder="Correo Electronico" autocomplete=off required/>
                            <!-- Contraseña -->
                            <div style="position: relative; width: 100%;">
                                <input type="password" id="user_password" name="user_password" placeholder="Contraseña" autocomplete="off" required style="width: 100%; padding-right: 40px;" />
                                <i class="fas fa-eye toggle-password" toggle="#user_password" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color: gray;"></i>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div style="position: relative; width: 100%;">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" autocomplete="off" required style="width: 100%; padding-right: 40px;" />
                                <i class="fas fa-eye toggle-password" toggle="#confirm_password" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color: gray;"></i>
                            </div>

                            <input type="file" name="imagen" id="imagen" accept="image/*" placeholder="Foto de perfil"/>
                            <input type="text" id="user_address" name="user_address" placeholder="Direccion" autocomplete=off required/>
                            <input type="text" id="user_number" name="user_number" placeholder="Telefono" autocomplete=off required/>

                            <input type="submit" name="user_register" value="Registrarse" class="" style="background: #04530E;"/>
                    </form>
                </div>
                <!-- fin user_register-->

                <!-- user_login-->
                <div class="form-container sign-in">
                    <form action="" method="POST">
                        <h1>Inicia Sesion</h1>
                        <input type="email" id="email_login" name="email_login" placeholder="Email" autocomplete=off required/>
                        <!-- Contraseña -->
                        <div style="position: relative; width: 100%;">
                            <input type="password" id="password_login" name="password_login" placeholder="Contraseña" autocomplete="off" required style="width: 100%; padding-right: 40px;" />
                            <i class="fas fa-eye toggle-password" toggle="#password_login" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color: gray;"></i>
                        </div>
                        <a href="#">Olvidaste tu Contraseña?</a>
                        
                        <input type="submit" name="user_login" value="Iniciar sesion" class="" style="background: #04530E;"/>
                    </form>
                </div>
                <!-- fin user_login-->

                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-left">
                            <h1> ¡Bienvenido!  </h1>
                            <p> Ingresa tus datos para ingresar </p>
                            <button class="hidden" id="login"> Inicia Sesion</button><!-- boton para mostrar user_login.php-->
                        </div>
                        <div class="toggle-panel toggle-right">
                            <h1>¡Hola De nuevo!</h1>
                            <p> Crea una cuenta nueva </p>
                            <button class="hidden" id="register">Registrate</button><!-- boton para mostrar user_register.php-->
                        </div>
                    </div>
                </div>
            </div> 
        </div>    
        
    </div>
    
    <script src="../js/animacioninicio.js"></script>
    
    <script>//ver contraseña
        const togglePasswordIcons = document.querySelectorAll(".toggle-password");

        togglePasswordIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const input = document.querySelector(this.getAttribute("toggle"));
                const type = input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);
                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");
            });
        });
    </script>
</body>
</html>

<?php
//register

    if(isset($_POST['user_register'])){
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $confirm_password=$_POST['confirm_password'];
        $user_address=$_POST['user_address'];
        $user_number=$_POST['user_number'];

        $imagen=$_FILES['imagen']['name'];
        $tmp_imagen=$_FILES['imagen']['tmp_name'];
        $img_extension=strtolower(pathinfo($imagen,PATHINFO_EXTENSION));//para validar la extension de la imagen


        //validaciones
        //campos vacios
        if (empty($user_name) || empty($user_email) || empty($user_password) || empty($confirm_password) || empty($user_address) || empty($user_number)) {
            echo "<script>alert('Todos los campos son obligatorios excepto la imagen.'); history.back();</script>";
            exit();
        }
        // Contraseña segura minimo 8 caracteres, al menos una mayuscula y un numero
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $user_password)) {
            echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.'); history.back();</script>";
            exit();
        }
        // Confirmación de contraseña
        if ($user_password !== $confirm_password) {
            echo "<script>alert('Las contraseñas no coinciden.'); history.back();</script>";
            exit();
        }
        // Teléfono: solo 10 números
        if (!preg_match('/^\d{10}$/', $user_number)) {
            echo "<script>alert('El teléfono debe tener exactamente 10 dígitos numéricos.'); history.back();</script>";
            exit();
        }
        // Verificar si el correo o teléfono ya están registrados
        $check_query = "SELECT * FROM usuarios WHERE email_usuario = ? OR telefono_usuario = ?";
        $stmt = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt, "ss", $user_email, $user_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('El correo o número de teléfono ya están registrados.'); history.back();</script>";
            exit();
        }

        // Procesar imagen
        if (!empty($imagen)) {
            if ($img_extension !== 'png' && $img_extension !== 'jpg' && $img_extension !== 'jpeg') {
                echo "<script>alert('Solo se permiten imágenes en formato PNG o JPG.'); history.back();</script>";
                exit();
            }
            //en caso de que la imagen tiene formato correcto, la imagen que será guardada tendra un nombre unico
            $unique_id = uniqid();
            $new_image_name = $unique_id . '_' . $imagen;
            move_uploaded_file($tmp_imagen, __DIR__ . "/users_images/$new_image_name");
        } else {
            //en caso de no cargar ninguna imagen se le asigna una predeterminada
            $new_image_name = 'usuario.jpg';
        }
        // Encriptar contraseña
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $insert_query = "INSERT INTO usuarios (nombre_usuario, email_usuario, contraseña_usuario, foto_perfil, direccion_usuario, telefono_usuario) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssssss", $user_name, $user_email, $hashed_password, $new_image_name, $user_address, $user_number);
        $sql_execute = mysqli_stmt_execute($stmt);

        if ($sql_execute) {
            echo "<script>alert('Usuario registrado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar.'); history.back();</script>";
        }

        //verificar si usuario tiene articulos en el carrito
        $select_cart_items="SELECT * FROM `carrito_detalles` where id_usuario=?";
        $stmt_cart=mysqli_prepare($con,$select_cart_items);
        mysqli_stmt_bind_param($stmt_cart,"i",$row_data['id_usuario']);
        mysqli_stmt_execute($stmt_cart);
        $result_cart=mysqli_stmt_get_result($stmt_cart);
        $rows_count=mysqli_num_rows($result_cart);

        if($rows_count>0){
            $_SESSION['useremail']=$user_email;
            echo "<script>alert(' tienes articulos en el carrito.');</script>";
            echo "<script>window.open('checkout.php','_self');</script>";
        }else{
            echo "<script>window.open('index.php','_self');</script>";
        }
    }
?>

<?php
//login
    if(isset($_POST['user_login'])){
        $email_login=$_POST['email_login'];
        $password_login=$_POST['password_login'];

        //obtener datos del usuario
        $select_query="SELECT * FROM `usuarios` where email_usuario=?";
        $stmt=mysqli_prepare($con,$select_query);
        mysqli_stmt_bind_param($stmt,"s",$email_login);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);

        //verificar si usuario tiene items en el carrito
        if($row_count>0){
            if(password_verify($password_login,$row_data['contraseña_usuario'])){//row_data es la contraseña guardada  y  password_login es la contraseña que ingresa el usuario y los compara
                //echo "<script>alert('Conexion exitosa')</script>";
                $_SESSION['useremail']=$email_login;
                $_SESSION['id_usuario']=$row_data['id_usuario'];
                echo "<script>alert('Conexion exitosa')</script>";

                migrar_carrito_a_usuario($row_data['id_usuario']);

                $select_query_cart="SELECT * FROM `carrito_detalles` where id_usuario=?";
                $stmt_cart=mysqli_prepare($con,$select_query_cart);
                mysqli_stmt_bind_param($stmt_cart,"i",$row_data['id_usuario']);
                mysqli_stmt_execute($stmt_cart);
                $result_cart=mysqli_stmt_get_result($stmt_cart);
                $row_count_cart=mysqli_num_rows($result_cart);

                $page = ($row_count_cart==0) ? "users-area/profile.php" : "../carrito.php";

                echo "<script>window.open('$page','_self')</script>";

            }else{
                echo "<script>alert('Contraseña inválida')</script>";
            }
        }else{
            echo "<script>alert('Correo inválido')</script>";
        }
    }    
?>