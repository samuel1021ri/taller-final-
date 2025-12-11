<?php
require '../config.php';
$res = $conexion->query("SELECT id_especialidad, nombre FROM especialidades ORDER BY nombre");
?>
<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><title>Especialidades</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-4">
  <div class="d-flex justify-content-between"><h3>Especialidades</h3><a href="crear_especialidad.php" class="btn btn-success">Crear</a></div>
  <table class="table mt-3"><thead><tr><th>ID</th><th>Nombre</th></tr></thead>
    <tbody><?php while($r=$res->fetch_assoc()){ ?><tr><td><?= $r['id_especialidad'] ?></td><td><?= htmlspecialchars($r['nombre']) ?></td></tr><?php } ?></tbody>
  </table>
  <a href="../index.php" class="btn btn-secondary">Volver</a>
</div>
</body></html>
