<?php
require '../config.php';

// Obtener todos los tickets para el selector
$tickets_res = $conexion->query("SELECT id_ticket, titulo, estado FROM tickets ORDER BY id_ticket DESC");

// Inicializar historial
$historial = null;
$ticket_actual = null;

if(isset($_GET['ticket'])){
    $id_ticket = intval($_GET['ticket']);

    // Obtener info del ticket actual (para mostrar estado)
    $ticket_actual = $conexion->query("SELECT * FROM tickets WHERE id_ticket=$id_ticket")->fetch_assoc();

    // Obtener historial de técnicos
    $historial = $conexion->query("
        SELECT h.id_historial, h.id_tecnico, h.fecha_asignacion, h.fecha_finalizacion, t.nombre AS tecnico
        FROM ticket_tecnico_historial h
        JOIN tecnicos t ON h.id_tecnico = t.id_tecnico
        WHERE h.id_ticket=$id_ticket
        ORDER BY h.fecha_asignacion ASC
    ");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial de Técnicos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Historial de Técnicos por Ticket</h2>

    <!-- Selector de ticket -->
    <form method="GET" class="mb-4">
        <label class="form-label">Selecciona un ticket:</label>
        <select name="ticket" class="form-select" onchange="this.form.submit()">
            <option value="">-- Elegir ticket --</option>
            <?php while($t = $tickets_res->fetch_assoc()){ ?>
                <option value="<?= $t['id_ticket'] ?>"
                    <?php if(isset($_GET['ticket']) && $_GET['ticket'] == $t['id_ticket']) echo 'selected'; ?>>
                    #<?= $t['id_ticket'] ?> - <?= htmlspecialchars($t['titulo']) ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <?php if($historial && $ticket_actual){ ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Técnico</th>
                    <th>Fecha Asignación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                while($h = $historial->fetch_assoc()){ ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($h['tecnico']) ?></td>
                        <td><?= $h['fecha_asignacion'] ?></td>
                        <td>
                            <?= $h['fecha_finalizacion'] ? 'Finalizado' : htmlspecialchars($ticket_actual['estado']) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <a href="../index.php" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
