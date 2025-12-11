<?php
require '../config.php';
if($_POST){
  $nombre = $conexion->real_escape_string($_POST['nombre']);
  $email = $conexion->real_escape_string($_POST['email']);
  $id_especialidad = $_POST['id_especialidad'] ?: "NULL";
  if($id_especialidad === "NULL") {
    $sql = "INSERT INTO tecnicos (nombre, email) VALUES ('$nombre', '$email')";
  } else {
    $sql = "INSERT INTO tecnicos (nombre, email, id_especialidad) VALUES ('$nombre', '$email', $id_especialidad)";
  }
  $conexion->query($sql);
  header("Location: listar_tecnicos.php");
  exit;
}
// obtener especialidades
$resEsp = $conexion->query("SELECT id_especialidad, nombre FROM especialidades ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"><title>Crear técnico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Crear técnico</h3>
  <form method="POST">
    <div class="mb-2"><label>Nombre</label><input required name="nombre" class="form-control"></div>
    <div class="mb-2"><label>Email</label><input name="email" class="form-control" type="email"></div>
    <div class="mb-2"><label>Especialidad</label>
      <select name="id_especialidad" class="form-select">
        <option value="">Sin asignar</option>
        <?php while($e = $resEsp->fetch_assoc()){ ?>
          <option value="<?= $e['id_especialidad'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
        <?php } ?>
      </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a href="listar_tecnicos.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body>
</html>
