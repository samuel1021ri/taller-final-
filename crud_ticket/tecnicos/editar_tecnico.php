
<?php
require '../config.php';
$id = intval($_GET['id']);
if($_POST){
  $nombre = $conexion->real_escape_string($_POST['nombre']);
  $email = $conexion->real_escape_string($_POST['email']);
  $id_especialidad = $_POST['id_especialidad'] ?: "NULL";
  $sql = "UPDATE tecnicos SET nombre='$nombre', email='$email', id_especialidad=" . ($id_especialidad === "NULL" ? "NULL" : $id_especialidad) . " WHERE id_tecnico=$id";
  $conexion->query($sql);
  header("Location: listar_tecnicos.php");
  exit;
}
$res = $conexion->query("SELECT * FROM tecnicos WHERE id_tecnico=$id");
$t = $res->fetch_assoc();
$resEsp = $conexion->query("SELECT id_especialidad, nombre FROM especialidades ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="utf-8"><title>Editar técnico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Editar técnico</h3>
  <form method="POST">
    <div class="mb-2"><label>Nombre</label><input name="nombre" class="form-control" required value="<?= htmlspecialchars($t['nombre']) ?>"></div>
    <div class="mb-2"><label>Email</label><input name="email" class="form-control" value="<?= htmlspecialchars($t['email']) ?>"></div>
    <div class="mb-2"><label>Especialidad</label>
      <select name="id_especialidad" class="form-select">
        <option value="">Sin asignar</option>
        <?php while($e = $resEsp->fetch_assoc()){ ?>
          <option value="<?= $e['id_especialidad'] ?>" <?= ($e['id_especialidad']==$t['id_especialidad'])?'selected':'' ?>>
            <?= htmlspecialchars($e['nombre']) ?></option>
        <?php } ?>
      </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a href="listar_tecnicos.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body>
</html>
