<?php
// tickets/eliminar_ticket.php
require '../config.php';

// id seguro
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0){
    header('Location: listar_tickets.php');
    exit;
}

// OPCIÓN A (recomendada si quieres eliminar completamente):
// Primero borramos historial y dependencias (por si no pusiste ON DELETE CASCADE)
$conexion->begin_transaction();

try {
    // borrar historial de técnicos
    $conexion->query("DELETE FROM ticket_tecnico_historial WHERE id_ticket = $id");

    // borrar dependencias donde el ticket es padre o hijo
    $conexion->query("DELETE FROM dependencias WHERE ticket_padre = $id OR ticket_hijo = $id");

    // finalmente borrar el ticket
    $conexion->query("DELETE FROM tickets WHERE id_ticket = $id");

    $conexion->commit();
    header("Location: listar_tickets.php");
    exit;
} catch (Exception $e) {
    $conexion->rollback();
    echo "<p style='color:red;'>Error al eliminar: " . htmlspecialchars($conexion->error) . "</p>";
    echo '<p><a href="listar_tickets.php">Volver</a></p>';
    exit;
}

/* 
// OPCIÓN B: Soft-delete (alternativa segura)
// Si prefieres no borrar datos, simplemente marca el ticket como 'cerrado' o añade un campo eliminado.
// Descomenta y usa en lugar del bloque anterior:

if($conexion->query("UPDATE tickets SET estado='cerrado' WHERE id_ticket=$id")){
    header("Location: listar_tickets.php");
    exit;
} else {
    echo "<p style='color:red;'>Error al actualizar estado: " . htmlspecialchars($conexion->error) . "</p>";
}
*/
?>
