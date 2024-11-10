<?php
    session_start();
    include 'config.php';

    if ($_SESSION['rol'] !== 'lider') {
        header("Location: login.php");
        exit;
    }

    $lider_id = $_SESSION['user_id'];
    $area_id = $_SESSION['area_id'];

    $stmt = $pdo->prepare("SELECT * FROM empleados WHERE area_id = :area_id");
    $stmt->execute(['area_id' => $area_id]);
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM reportes WHERE lider_id = :lider_id AND status = 'enviado'");
    $stmt->execute(['lider_id' => $lider_id]);
    $reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Líder de Área</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>

    <h3>Reporte Diario</h3>
    <form method="POST" action="guardar_reporte.php">
        <table>
            <tr>
                <th>Empleado</th>
                <th>Turno</th>
                <th>Bono</th>
                <th>Proyecto</th>
            </tr>
            <?php foreach($empleados as $empleado): ?>
            <tr>
                <td><?php echo $empleado['nombre']; ?></td>
                <td><input type="text" name="turno[<?php echo $empleado['id']; ?>]"></td>
                <td><input type="number" name="bono[<?php echo $empleado['id']; ?>]"></td>
                <td><input type="text" name="proyecto[<?php echo $empleado['id']; ?>]"></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" name="estado" value="borrador">Guardar como borrador</button>
        <button type="submit" name="estado" value="enviado">Enviar para aprobación</button>
    </form>

    <h3>Reportes anteriores</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Status</th>
        </tr>
        <?php foreach($reportes as $reporte): ?>
        <tr>
            <td><?php echo $reporte['id']; ?></td>
            <td><?php echo $reporte['fecha']; ?></td>
            <td><?php echo $reporte['status']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>