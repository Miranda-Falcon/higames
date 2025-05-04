<?php
session_start();
include('../includes/connect.php');

if(!isset($_SESSION['useremail'])){
    echo "<script>window.open('../index.php','_self')</script>";
}
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/profile.css">

    <title> HIGAMES</title>

</head>
<body>

    <div class="hg-wrapper">
        <div class="hg-header">
            <div class="container">
                <div class="header-menu">
                    <div class="hg-logo">
                        <a href="../index.php">
                            <img src="../img/HIGAMES.png" alt="Logo Higames">
                        </a>
                    </div>
                    <nav class="hg-menu">
                        <ul>
                            <li><a href="../index.php#productos">Productos</a></li>
                            <li><a href="#">Nosotros</a></li>
                            <li><a href="profile.php">Perfil</a></li>
                        </ul>

                        <?php
                        if(!isset($_SESSION['useremail'])){//boton login si no ha  iniciado sesion
                        ?>
                        <div class="hg-log">
                            <div class="container">
                                <ul class="hg-login">
                                    <li class="hg-tab">
                                        <a href="../index.php?login_register">Ingresar</a>
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
                                        <a href="cerrar_sesion.php">Cerrar Sesion</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                        <div class="hg-icon-cart" id="hg-icon-cart">
                            <a href="../carrito.php">
                                <i class="las la-shopping-cart"></i>
  
                            </a>
                        </div>   
                    </nav>
                </div>                   
            </div>
        </div><!--fin header-->


        <div class="hg-page-block bg-fondo" >
            <div class="container">
                <p id="admin-welcome" style="text-align: center; font-weight: 600; font-size: 30px">Perfil</p>
                 
                
                <div class="profile-container" style="display: flex; margin-top: 30px;">
                    <!-- Menú lateral -->
                    <div class="profile-sidebar" style="width: 250px; background: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); padding: 20px; margin-right: 30px;">
                        <div class="profile-menu-item" onclick="loadContent('welcome')" style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: all 0.3s;">
                            <i class="las la-user" style="margin-right: 10px;"></i> Mi perfil
                        </div>
                        <div class="profile-menu-item" onclick="loadContent('pending')" style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: all 0.3s;">
                            <i class="las la-clock" style="margin-right: 10px;"></i> Órdenes pendientes
                        </div>
                        <div class="profile-menu-item" onclick="loadContent('completed')" style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: all 0.3s;">
                            <i class="las la-check-circle" style="margin-right: 10px;"></i> Órdenes completadas
                        </div>
                        <div class="profile-menu-item" onclick="loadContent('edit')" style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: all 0.3s;">
                            <i class="las la-user-edit" style="margin-right: 10px;"></i> Editar perfil
                        </div>
                        <div class="profile-menu-item" onclick="loadContent('delete')" style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; transition: all 0.3s;">
                            <i class="las la-trash" style="margin-right: 10px;"></i> Eliminar cuenta
                        </div>
                        <div class="profile-menu-item" onclick="window.location.href='cerrar_sesion.php'" style="padding: 15px; cursor: pointer; transition: all 0.3s; color: #e74c3c;">
                            <i class="las la-sign-out-alt" style="margin-right: 10px;"></i> Cerrar sesión
                        </div>
                    </div>
                    
                    <!-- Contenido principal -->
                    <div class="profile-content" style="flex: 1; background: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                        <!-- Contenido de Bienvenida -->
                        <div id="welcome-content">
                            <?php
                                $user_id=$_SESSION['id_usuario'];
                                $query = "SELECT * FROM usuarios WHERE id_usuario = $user_id";
                                $result = mysqli_query($con, $query);
                                $user = mysqli_fetch_assoc($result);
                            ?>
                            <div style="text-align: center; margin-bottom: 30px;">
                                <img src="users_images/<?php echo $user['foto_perfil'];?>" 
                                    alt="Foto de perfil" 
                                    style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #04530E;">
                                <h3 style="color: #333; margin-top: 15px;">¡Holaaa! <?php echo htmlspecialchars($user['nombre_usuario']); ?></h3>
                            </div>
                            
                            <div style="max-width: 500px; margin: 0 auto;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                    <span style="font-weight: bold;">Email:</span>
                                    <span><?php echo htmlspecialchars($user['email_usuario']); ?></span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                    <span style="font-weight: bold;">Dirección:</span>
                                    <span><?php echo htmlspecialchars($user['direccion_usuario']); ?></span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="font-weight: bold;">Teléfono:</span>
                                    <span><?php echo htmlspecialchars($user['telefono_usuario']); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido de Órdenes pendientes (oculto por defecto) -->
                        <div id="pending-content" style="display: none;">
                            <h3 style="color: #333; margin-bottom: 20px;">Órdenes Pendientes</h3>
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #04530E; color: white;">
                                        <th style="padding: 10px; text-align: left;">Monto</th>
                                        <th style="padding: 10px; text-align: left;">Numero de Factura</th>
                                        <th style="padding: 10px; text-align: left;">Total de productos</th>
                                        <th style="padding: 10px; text-align: left;">Fecha</th>
                                        <th style="padding: 10px; text-align: left;">Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //código PHP para mostrar órdenes pendientes
                                    // Ejemplo:
                                    
                                    $user_id = $_SESSION['id_usuario'];
                                    $query = "SELECT * FROM user_orders WHERE id_usuario = $user_id AND status_orden = 'pendiente'";
                                    $result = mysqli_query($con, $query);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>\${$row['monto']}</td>
                                            <td>{$row['num_factura']}</td>
                                            <td>{$row['total_productos']}</td>
                                            <td>{$row['fecha_orden']}</td>
                                            <td>{$row['status_orden']}</td>
                                            
                                        </tr>";
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Contenido de Órdenes completadas (oculto por defecto) -->
                        <div id="completed-content" style="display: none;">
                            <h3 style="color: #333; margin-bottom: 20px;">Órdenes Completadas</h3>
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #04530E; color: white;">
                                        <th style="padding: 10px; text-align: left;">Monto</th>
                                        <th style="padding: 10px; text-align: left;">Numero de Factura</th>
                                        <th style="padding: 10px; text-align: left;">Total de productos</th>
                                        <th style="padding: 10px; text-align: left;">Fecha</th>
                                        <th style="padding: 10px; text-align: left;">Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //código PHP para mostrar órdenes pendientes
                                        // Ejemplo:
                                        
                                        $user_id = $_SESSION['id_usuario'];
                                        $query = "SELECT * FROM user_orders WHERE id_usuario = $user_id AND status_orden = 'completada'";
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                <td>\${$row['monto']}</td>
                                                <td>{$row['num_factura']}</td>
                                                <td>{$row['total_productos']}</td>
                                                <td>{$row['fecha_orden']}</td>
                                                <td>{$row['status_orden']}</td>
                                                
                                            </tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Contenido de Editar perfil (oculto por defecto) -->
                        <div id="edit-content" style="display: none;">
                            <h3 style="color: #333; margin-bottom: 20px;">Editar Perfil</h3>
                            <form action="" method="POST" enctype="multipart/form-data" style="max-width: 500px; margin: 0 auto;">
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre:</label>
                                    <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>" 
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                                    <input type="email" name="email_usuario" value="<?php echo htmlspecialchars($user['email_usuario']); ?>" 
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Dirección:</label>
                                    <input type="text" name="direccion_usuario" value="<?php echo htmlspecialchars($user['direccion_usuario']); ?>" 
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Teléfono:</label>
                                    <input type="tel" name="telefono_usuario" value="<?php echo htmlspecialchars($user['telefono_usuario']); ?>" 
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Foto de perfil:</label>
                                    <input type="file" name="foto_perfil" accept="image/*" style="width: 100%;">
                                    <small>Sube una imagen cuadrada para mejor resultado</small>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nueva contraseña:</label>
                                    <input type="password" name="nueva_contraseña" placeholder="Dejar en blanco para no cambiar" 
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Confirmar contraseña actual:</label>
                                    <input type="password" name="contraseña_actual"  
                                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                
                                <button type="submit" name="user_update" style="background-color: #04530E; color: white; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                                    <i class="las la-save" style="margin-right: 8px;"></i> Guardar cambios
                                </button>
                            </form>
                        </div>

                        <!-- Contenido de Eliminar cuenta (oculto por defecto) -->
                        <div id="delete-content" style="display: none; text-align: center;">
                            <h3 style="color: #333; margin-bottom: 20px;">¿Estás seguro de eliminar la cuenta?</h3>
                            <img src="../img/pikachu_cry.jpg" alt="Pikachu triste" style="max-width: 200px; margin-bottom: 20px;">
                            <div>
                                <button onclick="" style="background-color: #e74c3c; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px;">Sí, eliminar</button>
                                <button onclick="window.location.href='profile.php'" style="background-color: #04530E; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- FOOTER-->
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
                <p>HIGS STORE 2025 © Todos los derechos reservados</p>
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
        <script>
            // Función para cargar contenido
            function loadContent(section) {
                // Ocultar todos los contenidos
                document.querySelectorAll('.profile-content > div').forEach(div => {
                    div.style.display = 'none';
                });
                
                // Mostrar el contenido seleccionado
                document.getElementById(section + '-content').style.display = 'block';
                
                // Actualizar menú activo
                document.querySelectorAll('.profile-menu-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                if(section !== 'logout') {
                    const activeItem = document.querySelector(`.profile-menu-item[onclick="loadContent('${section}')"]`);
                    if(activeItem) activeItem.classList.add('active');
                }
            }
            
            // Mostrar contenido de bienvenida por defecto
            document.addEventListener('DOMContentLoaded', function() {
                loadContent('welcome');
            });
        </script>
</body>
</html>

<?php

?>