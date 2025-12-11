<?php
require '../config.php';
$id = intval($_GET['id']); // id_historial
$conexion->query("UPDATE ticket_tecnico_historial SET fecha_finalizacion=NOW() WHERE id_historial=$id");
header("Location: ver_historial.php");
exit;
