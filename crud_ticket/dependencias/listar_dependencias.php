<?php
require '../config.php';
$sql = "SELECT d.id_dependencia, d.ticket_padre, d.ticket_hijo, t1.titulo AS padre_titulo, t2.titulo AS hijo_titulo
        FROM dependencias d
        JOIN tickets t1 ON d.ticket_padre = t1.id_ticket
        JOIN tickets t2 ON d.ticket_hijo = t2.id_ticket
        ORDER BY d.id_dependencia DESC";
$res = $conexion->query($sql);
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Dependencias</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <div class="d-flex justify-content-between mb-3"><h3>Dependencias</h3><a href="crear_dependencia.php" class="btn btn-primary">Crear</a></div>
  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Ticket Padre</th><th>Ticket Hijo</th><th>Acciones</th></tr></thead>
    <tbody>
      <?php while($r=$res->fetch_assoc()){ ?>
        <tr>
          <td><?= $r['id_dependencia'] ?></td>
          <td>#<?= $r['ticket_padre'] ?> - <?= htmlspecialchars($r['padre_titulo']) ?></td>
          <td>#<?= $r['ticket_hijo'] ?> - <?= htmlspecialchars($r['hijo_titulo']) ?></td>
          <td>
            <a href="eliminar_dependencia.php?id=<?= $r['id_dependencia'] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Eliminar dependencia?')">Eliminar</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="../index.php" class="btn btn-secondary">Volver</a>
</div>
</body></html>
