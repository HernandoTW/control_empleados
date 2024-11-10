<?php
    session_start();
    include 'config.php';

    if ($_SESSION['rol'] !== 'jefe_rh') {
        header("Location: login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        list($accion, $reporte_id) = explode('-', $_POST['accion']);
        $status = ($accion === 'aprobar') ? 'aprobado' : 'corregir';

        $stmt = $pdo->prepare("UPDATE reportes SET status = :status WHERE id = :reporte_id");
        $stmt->execute(['status' => $status, 'reporte_id' => $reporte_id]);

        $stmt = $pdo->prepare("
            INSERT INTO aprobaciones (reporte_id, aprobado_por, status, comentario)
            VALUES (:reporte_id, :aprobado_por, :status, :comentario)
        ");
        $comentario = ($accion === 'corregir') ? 'Por favor, realiza las correcciones necesarias.' : '';
        $stmt->execute([
            'reporte_id' => $reporte_id,
            'aprobado_por' => $_SESSION['user_id'],
            'status' => $status,
            'comentario' => $comentario
        ]);
    }

    header("Location: inicio_jefe_rh.php");
    exit;
?>
