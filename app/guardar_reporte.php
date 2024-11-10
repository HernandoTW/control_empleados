<?php
    session_start();
    include 'config.php';

    if ($_SESSION['rol'] !== 'lider') {
        header("Location: login.php");
        exit;
    }

    $lider_id = $_SESSION['user_id'];
    $estado = $_POST['estado'];

    $stmt = $pdo->prepare("INSERT INTO reportes (lider_id, status) VALUES (:lider_id, :status)");
    $stmt->execute(['lider_id' => $lider_id, 'status' => $estado]);
    $reporte_id = $pdo->lastInsertId();

    foreach ($_POST['turno'] as $empleado_id => $turno) {
        $bono = $_POST['bono'][$empleado_id];
        $proyecto = $_POST['proyecto'][$empleado_id];

        $stmt = $pdo->prepare("INSERT INTO reportes_detalle (reporte_id, empleado_id, turno, bono, proyecto) VALUES (:reporte_id, :empleado_id, :turno, :bono, :proyecto)");
        $stmt->execute(['reporte_id' => $reporte_id, 'empleado_id' => $empleado_id, 'turno' => $turno, 'bono' => $bono, 'proyecto' => $proyecto]);
    }

    header("Location: inicio_lider.php");
    exit;
?>
