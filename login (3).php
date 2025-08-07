<?php
session_start();
include("conexion.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena_usuario = $_POST['contrasena'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM LOGIN WHERE usuarios = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $fila = $result->fetch_assoc();
        $contrasena_bd = $fila['contraseña'];

        if ($contrasena_usuario === $contrasena_bd) {
            $_SESSION['usuario'] = $fila['usuarios'];
            $_SESSION['rol'] = $fila['rol'];
            header("Location: panel.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f0e6;
            color: #3a2c1a;
            padding: 40px;
        }
        form {
            max-width: 320px;
            margin: auto;
            background: #fff8f0;
            padding: 20px;
            border: 2px solid #a77b47;
            border-radius: 10px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #a77b47;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #d9c4a3;
            color: #000;
        }
        .error {
            background-color: #fdd;
            border: 1px solid #f33;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            color: #900;
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Iniciar Sesión</h2>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>



