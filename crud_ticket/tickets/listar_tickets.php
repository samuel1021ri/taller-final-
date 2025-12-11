<?php
require '../config.php';
$sql = "SELECT t.id_ticket, t.titulo, t.estado, t.prioridad, t.tipo, te.nombre AS tecnico
        FROM tickets t
        LEFT JOIN tecnicos te ON t.id_tecnico = te.id_tecnico
        ORDER BY t.id_ticket DESC";
$res = $conexion->query($sql);
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Tickets</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Tickets</h3>
    <div>
      <a href="../index.php" class="btn btn-outline-secondary">Dashboard</a>
      <a href="crear_ticket.php" class="btn btn-primary">Crear Ticket</a>
    </div>
  </div>

  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Título</th><th>Prioridad</th><th>Estado</th><th>Técnico</th><th>Acciones</th></tr></thead>
    <tbody>
      <?php while($r = $res->fetch_assoc()){ ?>
        <tr>
          <td><?= $r['id_ticket'] ?></td>
          <td><?= htmlspecialchars($r['titulo']) ?></td>
          <td><?= $r['prioridad'] ?></td>
          <td><?= $r['estado'] ?></td>
          <td><?= $r['tecnico'] ?: 'Sin asignar' ?></td>
          <td>
            <a href="ver_ticket.php?id=<?= $r['id_ticket'] ?>" class="btn btn-sm btn-info">Ver</a>
            <a href="editar_ticket.php?id=<?= $r['id_ticket'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="eliminar_ticket.php?id=<?= $r['id_ticket'] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Eliminar ticket?')">Eliminar</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body></html>
