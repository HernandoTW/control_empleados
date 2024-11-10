<?php
session_start();
include 'config.php';

if ($_SESSION['rol'] !== 'lider') {
    header("Location: login.php");
    exit;
}

$lider_id = $_SESSION['user_id'];
$area_id = $_SESSION['area_id'];

// Obtener empleados del área
$stmt = $pdo->prepare("SELECT * FROM empleados WHERE area_id = :area_id");
$stmt->execute(['area_id' => $area_id]);
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener reportes enviados por el líder
$stmt = $pdo->prepare("SELECT * FROM reportes WHERE lider_id = :lider_id AND status = 'enviado'");
$stmt->execute(['lider_id' => $lider_id]);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener reportes devueltos para corrección
$stmt = $pdo->prepare("SELECT * FROM reportes WHERE lider_id = :lider_id AND status = 'corregir'");
$stmt->execute(['lider_id' => $lider_id]);
$reportes_devueltos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Líder de Área</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
        }
        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Bienvenido(a), <?php echo $_SESSION['nombre']; ?></h2><br>

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
                <td><input type="text" name="turno[<?php echo $empleado['id']; ?>]" required></td>
                <td><input type="number" name="bono[<?php echo $empleado['id']; ?>]" required></td>
                <td><input type="text" name="proyecto[<?php echo $empleado['id']; ?>]" required></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" name="estado" value="borrador">Guardar borrador</button>
        <button type="submit" name="estado" value="enviado">Enviar para aprobación</button>
    </form>
    
    <br>
    <h3>Reportes devueltos para corrección</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Observaciones</th>
            <th>Acción</th>
        </tr>
        <?php foreach($reportes_devueltos as $reporte): ?>
        <tr>
            <td><?php echo $reporte['id']; ?></td>
            <td><?php echo $reporte['fecha']; ?></td>
            <td><?php echo $reporte['observacion']; ?></td>
            <td>
                <a href="corregir_reporte.php?reporte_id=<?php echo $reporte['id']; ?>">Corregir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Agregar botón para redirigir al historial de reportes -->
    <button onclick="window.location.href='historial_reportes.php'">Ver historial de reportes</button>
    <br><br><br>
    <h3>Gestionar registro biométrico</h3>
    <a href="biometrico.php">Ver y registrar historial biométrico</a>
</body>
</html>
