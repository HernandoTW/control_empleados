<?php
    session_start();
    include 'config.php';

    if ($_SESSION['rol'] !== 'lider') {
        header("Location: login.php");
        exit;
    }

    $area_id = $_SESSION['area_id'];

    $stmt = $pdo->prepare("
        SELECT * FROM biometrico b
        JOIN empleados e ON b.empleado_id = e.id
        WHERE e.area_id = :area_id
    ");
    $stmt->execute(['area_id' => $area_id]);
    $registros_biometricos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($registros_biometricos as $registro) {
            $stmt = $pdo->prepare("
                INSERT INTO biometrico_historial (empleado_id, fecha_ingreso, fecha_salida, fecha_registro)
                VALUES (:empleado_id, :fecha_ingreso, :fecha_salida, :fecha_registro)
            ");
            $stmt->execute([
                'empleado_id' => $registro['empleado_id'],
                'fecha_ingreso' => $registro['fecha_ingreso'],
                'fecha_salida' => $registro['fecha_salida'],
                'fecha_registro' => $registro['fecha_registro']
            ]);
        }
        $mensaje = "Registros guardados en el historial exitosamente.";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros Biométricos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Registros Biométricos - Área: <?php echo $_SESSION['area_id']; ?></h2>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

    <form method="POST">
        <table>
            <tr>
                <th>Empleado</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Fecha Registro</th>
            </tr>
            <?php foreach ($registros_biometricos as $registro): ?>
            <tr>
                <td><?php echo $registro['nombre']; ?></td>
                <td><?php echo $registro['fecha_ingreso']; ?></td>
                <td><?php echo $registro['fecha_salida']; ?></td>
                <td><?php echo $registro['fecha_registro']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Guardar en Historial</button>
    </form>
</body>
</html>
