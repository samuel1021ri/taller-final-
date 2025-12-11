<?php
require '../config.php';
$tickets = $conexion->query("SELECT id_ticket, titulo FROM tickets ORDER BY id_ticket DESC");
if($_POST){
  $padre = intval($_POST['ticket_padre']);
  $hijo = intval($_POST['ticket_hijo']);
  if($padre == $hijo){
    $error = "Un ticket no puede depender de sí mismo.";
  } else {
    $conexion->query("INSERT INTO dependencias (ticket_padre, ticket_hijo) VALUES ($padre, $hijo)");
    header("Location: listar_dependencias.php");
    exit;
  }
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Crear dependencia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Crear dependencia</h3>
  <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="POST">
    <div class="mb-2"><label>Ticket padre</label>
      <select name="ticket_padre" class="form-select"><?php $tickets->data_seek(0); while($t=$tickets->fetch_assoc()){ ?><option value="<?= $t['id_ticket'] ?>">#<?= $t['id_ticket'] ?> - <?= htmlspecialchars($t['titulo']) ?></option><?php } ?></select>
    </div>
    <div class="mb-2"><label>Ticket hijo</label>
      <select name="ticket_hijo" class="form-select"><?php $tickets->data_seek(0); while($t=$tickets->fetch_assoc()){ ?><option value="<?= $t['id_ticket'] ?>">#<?= $t['id_ticket'] ?> - <?= htmlspecialchars($t['titulo']) ?></option><?php } ?></select>
    </div>
    <button class="btn btn-primary">Crear</button>
    <a href="listar_dependencias.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>
</body></html>
