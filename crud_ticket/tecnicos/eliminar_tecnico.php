<?php
require '../config.php';
$id = intval($_GET['id']);
$conexion->query("DELETE FROM tecnicos WHERE id_tecnico=$id");
header("Location: listar_tecnicos.php");
exit;
