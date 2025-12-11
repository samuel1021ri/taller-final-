<?php
require '../config.php';
$resTec = $conexion->query("SELECT id_tecnico, nombre FROM tecnicos ORDER BY nombre");
if($_POST){
  $titulo = $conexion->real_escape_string($_POST['titulo']);
  $descripcion = $conexion->real_escape_string($_POST['descripcion']);
  $prioridad = $conexion->real_escape_string($_POST['prioridad']);
  $tipo = $conexion->real_escape_string($_POST['tipo']);
  $id_tecnico = intval($_POST['id_tecnico']);

  $sql = "INSERT INTO tickets (titulo, descripcion, prioridad, tipo, id_tecnico) VALUES ('$titulo', '$descripcion', '$prioridad', '$tipo', " . ($id_tecnico>0 ? $id_tecnico : "NULL") . ")";
  if($conexion->query($sql)){
    $id_ticket = $conexion->insert_id;
    if($id_tecnico>0){
      $conexion->query("INSERT INTO ticket_tecnico_historial (id_ticket, id_tecnico) VALUES ($id_ticket, $id_tecnico)");
    }
    header("Location: listar_tickets.php");
    exit;
  } else {
    $error = $conexion->error;
  }
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Crear Ticket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Crear Ticket</h3>
  <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="POST">
    <div class="mb-2"><label>Título</label><input required name="titulo" class="form-control"></div>
    <div class="mb-2"><label>Descripción</label><textarea required name="descripcion" class="form-control"></textarea></div>
    <div class="mb-2"><label>Prioridad</label>
      <select name="prioridad" class="form-select" required>
        <option value="baja">Baja</option><option value="media">Media</option><option value="alta">Alta</option><option value="critica">Crítica</option>
      </select>
    </div>
    <div class="mb-2"><label>Tipo</label>
      <select name="tipo" class="form-select" required>
        <option value="manual">Manual</option><option value="automatico">Automático</option>
      </select>
    </div>
    <div class="mb-2"><label>Técnico (opcional)</label>
      <select name="id_tecnico" class="form-select">
        <option value="0">-- Sin asignar --</option>
        <?php while($t = $resTec->fetch_assoc()){ ?>
          <option value="<?= $t['id_tecnico'] ?>"><?= htmlspecialchars($t['nombre']) ?></option>
        <?php } ?>
      </select>
    </div>
    <button class="btn btn-primary">Crear</button>
    <a href="listar_tickets.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body></html>
