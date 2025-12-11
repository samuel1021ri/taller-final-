<?php
require '../config.php';
$id = intval($_GET['id']);
$res = $conexion->query("SELECT t.*, te.nombre AS tecnico FROM tickets t LEFT JOIN tecnicos te ON t.id_tecnico=te.id_tecnico WHERE id_ticket=$id");
$ticket = $res->fetch_assoc();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Ver ticket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Ticket #<?= $ticket['id_ticket'] ?> - <?= htmlspecialchars($ticket['titulo']) ?></h3>
  <p><strong>Estado:</strong> <?= $ticket['estado'] ?> | <strong>Prioridad:</strong> <?= $ticket['prioridad'] ?> | <strong>Tipo:</strong> <?= $ticket['tipo'] ?></p>
  <p><strong>Técnico actual:</strong> <?= $ticket['tecnico'] ?: 'Sin asignar' ?></p>
  <h5>Descripción</h5>
  <p><?= nl2br(htmlspecialchars($ticket['descripcion'])) ?></p>

  <a href="listar_tickets.php" class="btn btn-secondary">Volver</a>
  <a href="../historial/ver_historial.php?ticket=<?= $ticket['id_ticket'] ?>" class="btn btn-info ms-2">Ver historial</a>
</div>
</body></html>
