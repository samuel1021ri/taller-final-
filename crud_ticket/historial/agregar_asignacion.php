<?php
require '../config.php';
if($_POST){
  $id_ticket = intval($_POST['id_ticket']);
  $id_tecnico = intval($_POST['id_tecnico']);
  // cerrar asignación anterior si existe (opcional)
  $conexion->query("UPDATE ticket_tecnico_historial SET fecha_finalizacion=NOW() WHERE id_ticket=$id_ticket AND fecha_finalizacion IS NULL");
  $conexion->query("INSERT INTO ticket_tecnico_historial (id_ticket, id_tecnico) VALUES ($id_ticket, $id_tecnico)");
  $conexion->query("UPDATE tickets SET id_tecnico=$id_tecnico WHERE id_ticket=$id_ticket");
  header("Location: ver_historial.php?ticket=$id_ticket");
  exit;
}
$tickets = $conexion->query("SELECT id_ticket, titulo FROM tickets ORDER BY id_ticket DESC");
$tecnicos = $conexion->query("SELECT id_tecnico, nombre FROM tecnicos ORDER BY nombre");
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Asignar técnico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Asignar técnico a ticket</h3>
  <form method="POST">
    <div class="mb-2"><label>Ticket</label>
      <select name="id_ticket" class="form-select" required><?php while($t=$tickets->fetch_assoc()){ ?><option value="<?= $t['id_ticket'] ?>">#<?= $t['id_ticket'] ?> - <?= htmlspecialchars($t['titulo']) ?></option><?php } ?></select>
    </div>
    <div class="mb-2"><label>Técnico</label>
      <select name="id_tecnico" class="form-select" required><?php while($r=$tecnicos->fetch_assoc()){ ?><option value="<?= $r['id_tecnico'] ?>"><?= htmlspecialchars($r['nombre']) ?></option><?php } ?></select>
    </div>
    <button class="btn btn-primary">Asignar</button>
    <a href="ver_historial.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body></html>
