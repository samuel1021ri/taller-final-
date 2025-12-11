<?php

require '../config.php';
$id = intval($_GET['id']);
if($_POST){
  $titulo = $conexion->real_escape_string($_POST['titulo']);
  $descripcion = $conexion->real_escape_string($_POST['descripcion']);
  $prioridad = $conexion->real_escape_string($_POST['prioridad']);
  $estado = $conexion->real_escape_string($_POST['estado']);
  $conexion->query("UPDATE tickets SET titulo='$titulo', descripcion='$descripcion', prioridad='$prioridad', estado='$estado' WHERE id_ticket=$id");
  header("Location: listar_tickets.php"); exit;
}
$res = $conexion->query("SELECT * FROM tickets WHERE id_ticket=$id");
$t = $res->fetch_assoc();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Editar ticket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Editar Ticket #<?= $t['id_ticket'] ?></h3>
  <form method="POST">
    <div class="mb-2"><label>Título</label><input name="titulo" class="form-control" value="<?= htmlspecialchars($t['titulo']) ?>"></div>
    <div class="mb-2"><label>Descripción</label><textarea name="descripcion" class="form-control"><?= htmlspecialchars($t['descripcion']) ?></textarea></div>
    <div class="mb-2"><label>Prioridad</label>
      <select name="prioridad" class="form-select">
        <option <?= $t['prioridad']=='baja'?'selected':'' ?> value="baja">baja</option>
        <option <?= $t['prioridad']=='media'?'selected':'' ?> value="media">media</option>
        <option <?= $t['prioridad']=='alta'?'selected':'' ?> value="alta">alta</option>
        <option <?= $t['prioridad']=='critica'?'selected':'' ?> value="critica">critica</option>
      </select>
    </div>
    <div class="mb-2"><label>Estado</label>
      <select name="estado" class="form-select">
        <option <?= $t['estado']=='abierto'?'selected':'' ?> value="abierto">abierto</option>
        <option <?= $t['estado']=='en proceso'?'selected':'' ?> value="en proceso">en proceso</option>
        <option <?= $t['estado']=='resuelto'?'selected':'' ?> value="resuelto">resuelto</option>
        <option <?= $t['estado']=='cerrado'?'selected':'' ?> value="cerrado">cerrado</option>
      </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a href="listar_tickets.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body></html>
