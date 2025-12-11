

<?php
require '../config.php';
$sql = "SELECT t.id_tecnico, t.nombre, t.email, e.nombre AS especialidad
        FROM tecnicos t
        LEFT JOIN especialidades e ON t.id_especialidad = e.id_especialidad
        ORDER BY t.nombre ASC";
$res = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Técnicos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Técnicos</h3>
    <div>
      <a href="../index.php" class="btn btn-outline-secondary">Dashboard</a>
      <a href="crear_tecnico.php" class="btn btn-primary">Crear</a>
    </div>
  </div>

  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Especialidad</th><th>Acciones</th></tr></thead>
    <tbody>
      <?php while($r = $res->fetch_assoc()) { ?>
        <tr>
          <td><?= $r['id_tecnico'] ?></td>
          <td><?= htmlspecialchars($r['nombre']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= $r['especialidad'] ?: 'Sin asignar' ?></td>
          <td>
            <a href="editar_tecnico.php?id=<?= $r['id_tecnico'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="eliminar_tecnico.php?id=<?= $r['id_tecnico'] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Eliminar técnico?')">Eliminar</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
