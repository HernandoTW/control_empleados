<?php
session_start();
include 'config.php';

if ($_SESSION['rol'] !== 'lider') {
    header("Location: login.php");
    exit;
}

$area_id = $_SESSION['area_id'];

// Obtener los registros biométricos de los empleados del área del líder
$stmt = $pdo->prepare("
    SELECT * FROM biometrico b
    JOIN empleados e ON b.empleado_id = e.id
    WHERE e.area_id = :area_id
");
$stmt->execute(['area_id' => $area_id]);
$registros_biometricos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Guardar en el historial cuando se envía el formulario
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

// Paginación
$registros_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener los registros del historial paginados
$stmt = $pdo->prepare("
    SELECT * FROM biometrico_historial bh
    JOIN empleados e ON bh.empleado_id = e.id
    ORDER BY bh.fecha_registro DESC
    LIMIT :offset, :registros_por_pagina
");
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$registros_historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT COUNT(*) FROM biometrico_historial");
$total_registros = $stmt->fetchColumn();
$total_paginas = ceil($total_registros / $registros_por_pagina);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros Biométricos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Registros Biométricos - Líder: <?php echo $_SESSION['nombre']; ?></h2>

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

    <br><hr><br>

    <h3>Historial Biométrico</h3>
    <table>
        <tr>
            <th>Empleado</th>
            <th>Fecha Ingreso</th>
            <th>Fecha Salida</th>
            <th>Fecha Registro</th>
        </tr>
        <?php foreach ($registros_historial as $registro): ?>
        <tr>
            <td><?php echo $registro['nombre']; ?></td>
            <td><?php echo $registro['fecha_ingreso']; ?></td>
            <td><?php echo $registro['fecha_salida']; ?></td>
            <td><?php echo $registro['fecha_registro']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Paginación -->
    <div class="paginacion">
        <?php if ($pagina_actual > 1): ?>
            <a href="biometrico.php?pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a>
        <?php endif; ?>

        <span>Página <?php echo $pagina_actual; ?> de <?php echo $total_paginas; ?></span>

        <?php if ($pagina_actual < $total_paginas): ?>
            <a href="biometrico.php?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
        <?php endif; ?>
    </div>

    <br><br>
    <a href="inicio_lider.php" class="boton">Volver a inicio</a>
</body>
</html>
