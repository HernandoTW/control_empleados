<?php
session_start();
include 'config.php';

if ($_SESSION['rol'] !== 'lider') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['reporte_id'])) {
    echo "Error: ID de reporte no especificado.";
    exit;
}

$reporte_id = $_GET['reporte_id'];
$stmt = $pdo->prepare("SELECT * FROM reportes_detalle WHERE reporte_id = :reporte_id");
$stmt->execute(['reporte_id' => $reporte_id]);
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['turno'] as $empleado_id => $turno) {
        $stmt = $pdo->prepare("
            UPDATE reportes_detalle 
            SET turno = :turno, bono = :bono, proyecto = :proyecto 
            WHERE reporte_id = :reporte_id AND empleado_id = :empleado_id
        ");
        $stmt->execute([
            'turno' => $turno,
            'bono' => $_POST['bono'][$empleado_id],
            'proyecto' => $_POST['proyecto'][$empleado_id],
            'reporte_id' => $reporte_id,
            'empleado_id' => $empleado_id
        ]);
    }
    // Cambiamos el status para reenviar
    $stmt = $pdo->prepare("UPDATE reportes SET status = 'enviado' WHERE id = :reporte_id");
    $stmt->execute(['reporte_id' => $reporte_id]);
    header("Location: inicio_lider.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Corregir reporte</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h3>Corregir Reporte</h3>
    <form method="POST">
        <table>
            <tr>
                <th>Empleado</th>
                <th>Turno</th>
                <th>Bono</th>
                <th>Proyecto</th>
            </tr>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?php echo $detalle['empleado_id']; ?></td>
                <td><input type="text" name="turno[<?php echo $detalle['empleado_id']; ?>]" value="<?php echo $detalle['turno']; ?>"></td>
                <td><input type="number" name="bono[<?php echo $detalle['empleado_id']; ?>]" value="<?php echo $detalle['bono']; ?>"></td>
                <td><input type="text" name="proyecto[<?php echo $detalle['empleado_id']; ?>]" value="<?php echo $detalle['proyecto']; ?>"></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Reenviar para Aprobación</button>
    </form>
</body>
</html>
