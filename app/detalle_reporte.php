<?php
    include 'config.php';

    if (!isset($_GET['reporte_id'])) {
        echo "Error: ID de reporte no especificado.";
        exit;
    }

    $reporte_id = $_GET['reporte_id'];
    $stmt = $pdo->prepare("SELECT empleados.nombre, reportes_detalle.turno, reportes_detalle.bono, reportes_detalle.proyecto, reportes_detalle.status 
                        FROM reportes_detalle 
                        JOIN empleados ON empleados.id = reportes_detalle.empleado_id 
                        WHERE reportes_detalle.reporte_id = :reporte_id");
    $stmt->execute(['reporte_id' => $reporte_id]);
    $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($detalles): ?>
        <table>
            <tr>
                <th>Empleado</th>
                <th>Turno</th>
                <th>Bono</th>
                <th>Proyecto</th>
                <th>Status</th>
            </tr>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?php echo $detalle['nombre']; ?></td>
                <td><?php echo $detalle['turno']; ?></td>
                <td><?php echo $detalle['bono']; ?></td>
                <td><?php echo $detalle['proyecto']; ?></td>
                <td><?php echo $detalle['status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron detalles para este reporte.</p>
    <?php endif; ?>
