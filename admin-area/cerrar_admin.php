<?php
session_start();

// Destruir solo las variables de sesión de admin
unset($_SESSION['user_admin']);

// Redirigir al login de admin
header('Location: admin_login.php');
exit;
?>