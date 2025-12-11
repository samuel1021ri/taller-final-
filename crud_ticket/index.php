
<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Dashboard - Sistema de Tickets</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Sistema de Tickets</a>
  </div>
</nav>

<div class="container mt-4">
  <div class="row g-3">
    <div class="col-12 col-md-4">
      <div class="card p-3">
        <h5>Tickets</h5>
        <p class="text-muted">Crear y listar tickets</p>
        <a href="tickets/listar_tickets.php" class="btn btn-primary">Ir</a>
        <a href="tickets/crear_ticket.php" class="btn btn-outline-primary ms-2">Crear</a>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card p-3">
        <h5>Técnicos</h5>
        <p class="text-muted">Gestionar técnicos</p>
        <a href="tecnicos/listar_tecnicos.php" class="btn btn-warning">Ir</a>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card p-3">
        <h5>Dependencias</h5>
        <p class="text-muted">Relacionar tickets</p>
        <a href="dependencias/listar_dependencias.php" class="btn btn-secondary">Ir</a>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card p-3">
        <h5>Historial técnico</h5>
        <p class="text-muted">Ver asignaciones por ticket</p>
        <a href="historial/ver_historial.php" class="btn btn-info">Ir</a>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card p-3">
        <h5>Especialidades</h5>
        <p class="text-muted">CRUD de especialidades</p>
        <a href="especialidades/listar_especialidades.php" class="btn btn-success">Ir</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>

