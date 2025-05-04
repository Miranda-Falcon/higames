<?php
session_start();
include('../includes/connect.php'); // Asegúrate de que esta conexión funcione bien

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

    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="hg-wrapper">

        <div class="hg-header">      
            <div class="header-menu">
                <div class="hg-logo">
                    <a href="index.php">
                        <img src="../img/HIGAMES.png" alt="Logo Higames">
                    </a>
                </div>
                <?php
                    if(isset($_SESSION['user_admin'])){
                ?>
                <nav class="hg-menu">
                    <ul>
                        <li><a href="index.php?agregar_produc">Agregar_Productos</a></li>
                        <li><a href="ver_productos.php">Ver_Productos</a></li>
                        <li><a href="#">Ordenes pendientes</a></li>
                        <li><a href="#">Ordenes completadas</a></li>
                        <li><a href="ver_usuarios.php">Usuarios</a></li>
                    </ul>

                    <div class="hg-log">
                        <div class="container">
                            <ul class="hg-login">
                                <li class="hg-tab">
                                    <a href="../index.php">Cerrar Sesion</a>
                                </li>
                            </ul>    
                        </div>
                    </div>
                </nav>
                <?php
                    }
                ?>
            </div>                         
        </div>

        <div class="hg-sign">
            <div class="container" id="container">

                <!-- admin login-->
                <div class="form-container sign-in">
                    <form action="" method="POST">
                        <h1>Inicia Sesion</h1>
                        <input type="text" id="user_admin" name="user_admin" placeholder="Usuario" autocomplete=off required/>
                        <!-- Contraseña -->
                        <div style="position: relative; width: 100%;">
                            <input type="password" id="password_login" name="password_login" placeholder="Contraseña" autocomplete="off" required style="width: 100%; padding-right: 40px;" />
                            <i class="fas fa-eye toggle-password" toggle="#password_login" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color: gray;"></i>
                        </div>
                        <a href="#">Olvidaste tu Contraseña?</a>
                        
                        <input type="submit" name="admin_login" value="Iniciar sesion" class="" style="background: #04530E;"/>
                    </form>
                </div>
                <!-- fin admin login-->

                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-right">
                            <h1>¡Hola De nuevo!</h1>
                            <p> Ingresa tus credenciales de administrador </p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>    
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

?>

<?php
//login
   if(isset($_POST['admin_login'])){

        $user_admin=$_POST['user_admin'];
        $password_login=$_POST['password_login'];

        //obtener datos del usuario
        $select_query="SELECT * FROM `admin_table` where user_admin=?";
        $stmt=mysqli_prepare($con,$select_query);
        mysqli_stmt_bind_param($stmt,"s",$user_admin);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);

        
        if($row_count>0){
            if(password_verify($password_login,$row_data['password_admin'])){//row_data es la contraseña guardada  y  password_login es la contraseña que ingresa el usuario y los compara
                //echo "<script>alert('Conexion exitosa')</script>";
                $_SESSION['user_admin']=$user_admin;
                
                echo "<script>alert('Conexion exitosa')</script>";

                echo "<script>window.open('index.php','_self')</script>";

            }else{
                echo "<script>alert('Contraseña inválida')</script>";
            }
        }else{
            echo "<script>alert('Usuario inválido')</script>";
        }
   }
?>