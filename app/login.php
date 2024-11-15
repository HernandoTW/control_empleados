<?php
    session_start();
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['area_id'] = $user['area_id'];
            $_SESSION['nombre'] = $user['nombre'];


            if ($user['rol'] === 'lider') {
                header("Location: inicio_lider.php");
            } elseif ($user['rol'] === 'jefe_rh') {
                header("Location: inicio_jefe_rh.php");
            }
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <br><br>
        <input type="password" name="password" placeholder="Contraseña" required>
        <br><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
