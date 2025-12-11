<?php
$conexion = new mysqli("localhost", "root", "", "crud_ticket");

if ($conexion->connect_errno) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
