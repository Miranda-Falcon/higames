<?php

$con=mysqli_connect('db','root','root123','db_carrito');//('localhost','usuario de la BD','Contraseña de la BD si no tiene solo dejar '' ', 'nombre de la base de datos')
if(!$con){
    die(mysqli_error($con));
}

?>