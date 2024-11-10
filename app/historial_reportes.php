<?php
session_start();
include 'config.php';

if ($_SESSION['rol'] !== 'lider') {
    header("Location: login.php");
    exit;
}

$lider_id = $_SESSION['user_id'];

// Obtener reportes enviados por el líder
$stmt = $pdo->prepare("SELECT * FROM reportes WHERE lider_id = :lider_id AND status = 'enviado'");
$stmt->execute(['lider_id' => $lider_id]);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Historial de Reportes - Líder de Área</title>
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

    <h3>Historial de reportes</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Status</th>
            <th>Ver detalle</th>
        </tr>
        <?php foreach($reportes as $reporte): ?>
        <tr>
            <td><?php echo $reporte['id']; ?></td>
            <td><?php echo $reporte['fecha']; ?></td>
            <td><?php echo $reporte['status']; ?></td>
            <td><button onclick="verDetalle(<?php echo $reporte['id']; ?>)">Ver detalle</button></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br><br>
    <a href="inicio_lider.php" class="boton">Volver a inicio</a>

    <!-- Modal para ver detalles del reporte -->
    <div id="detalleModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h3>Detalles del Reporte</h3>
            <div id="detalleContenido">
                <!-- Aquí se cargará el contenido de los detalles -->
            </div>
        </div>
    </div>

    <script>
        function verDetalle(reporte_id) {
            // Realizar una solicitud AJAX para obtener los detalles del reporte
            fetch('detalle_reporte.php?reporte_id=' + reporte_id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detalleContenido').innerHTML = data;
                    document.getElementById('detalleModal').style.display = 'flex';
                });
        }

        function cerrarModal() {
            document.getElementById('detalleModal').style.display = 'none';
        }
    </script>
</body>
</html>
