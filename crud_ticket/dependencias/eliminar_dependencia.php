<?php
require '../config.php';
$id = intval($_GET['id']);
$conexion->query("DELETE FROM dependencias WHERE id_dependencia=$id");
header("Location: listar_dependencias.php");
exit;
