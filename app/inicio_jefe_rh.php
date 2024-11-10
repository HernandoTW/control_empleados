<?php
    session_start();
    include 'config.php';

    if ($_SESSION['rol'] !== 'jefe_rh') {
        header("Location: login.php");
        exit;
    }

    $stmt = $pdo->prepare("
        SELECT r.id AS reporte_id, u.nombre AS lider_nombre, a.nombre AS area_nombre, r.fecha, r.status 
        FROM reportes r
        JOIN usuarios u ON r.lider_id = u.id
        JOIN areas a ON u.area_id = a.id
        WHERE r.status = 'enviado'
    ");
    $stmt->execute();
    $reportes_pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("
        SELECT r.id AS reporte_id, u.nombre AS lider_nombre, a.nombre AS area_nombre, r.fecha, r.status 
        FROM reportes r
        JOIN usuarios u ON r.lider_id = u.id
        JOIN areas a ON u.area_id = a.id
        WHERE r.status IN ('aprobado', 'corregir')
    ");
    $stmt->execute();
    $historial_reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Jefe RH</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>

    <h3>Reportes Pendientes de Aprobación</h3>
    <form method="POST" action="aprobar_reporte.php">
        <table>
            <tr>
                <th>ID</th>
                <th>Líder</th>
                <th>Área</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <?php foreach($reportes_pendientes as $reporte): ?>
            <tr>
                <td><?php echo $reporte['reporte_id']; ?></td>
                <td><?php echo $reporte['lider_nombre']; ?></td>
                <td><?php echo $reporte['area_nombre']; ?></td>
                <td><?php echo $reporte['fecha']; ?></td>
                <td>
                    <button type="submit" name="accion" value="aprobar-<?php echo $reporte['reporte_id']; ?>">Aprobar</button>
                    <button type="submit" name="accion" value="corregir-<?php echo $reporte['reporte_id']; ?>">Corregir</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </form>

    <h3>Historial de Reportes</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Líder</th>
            <th>Área</th>
            <th>Fecha</th>
            <th>Status</th>
        </tr>
        <?php foreach($historial_reportes as $reporte): ?>
        <tr>
            <td><?php echo $reporte['reporte_id']; ?></td>
            <td><?php echo $reporte['lider_nombre']; ?></td>
            <td><?php echo $reporte['area_nombre']; ?></td>
            <td><?php echo $reporte['fecha']; ?></td>
            <td><?php echo $reporte['status']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
