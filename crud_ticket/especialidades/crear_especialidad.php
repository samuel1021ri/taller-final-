<?php
require '../config.php';
if($_POST){
  $n = $conexion->real_escape_string($_POST['nombre']);
  $conexion->query("INSERT INTO especialidades (nombre) VALUES ('$n')");
  header("Location: listar_especialidades.php");
  exit;
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Crear especialidad</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Crear especialidad</h3>
  <form method="POST">
    <div class="mb-2"><input required name="nombre" class="form-control"></div>
    <button class="btn btn-success">Crear</button>
    <a href="listar_especialidades.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body></html>
