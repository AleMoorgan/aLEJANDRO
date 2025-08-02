<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
include("conexion.php");

// Obtener el rol
$usuario = $_SESSION['usuario'];
$stmt = $conn->prepare("SELECT rol FROM LOGIN WHERE usuarios = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
$rol = $datos['rol'] ?? 'usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 👈 Responsivo -->
    <title>Panel - Armería RDR2</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Playfair Display', serif;
            background-image: url('imagenes/fondo_saint_denis.jpg'); /* Usa una imagen de fondo de armería si tienes */
            background-size: cover;
            background-position: center;
            color: #f8f0e3;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .contenedor {
            background-color: rgba(43, 32, 25, 0.95);
            padding: 40px;
            border: 3px solid #b7936b;
            border-radius: 15px;
            box-shadow: 0 0 20px #b7936b;
            text-align: center;
            width: 400px;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #d9c4a3;
        }
        h2 {
            margin-top: 20px;
            font-size: 20px;
            color: #f1d7b6;
        }
        p {
            margin: 0;
            font-size: 16px;
        }
        .boton {
            display: block;
            background-color: #a97855;
            color: #fff;
            padding: 12px;
            margin: 10px auto;
            border: none;
            border-radius: 8px;
            width: 80%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .boton:hover {
            background-color: #d9c4a3;
            color: #000;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h1>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>

        <?php if ($rol === 'admin'): ?>
            <h2>Panel de Administración</h2>
            <a href="agregar_arma.php" class="boton">Agregar Arma</a>
            <a href="modificar_arma.php" class="boton">Modificar Arma</a>
            <a href="borrar_arma.php" class="boton">Borrar Arma</a>
        <?php else: ?>
            <h2>Catálogo de Armas</h2>
            <a href="comprar.php" class="boton">Comprar Armas</a>
        <?php endif; ?>

        <a href="cerrar_sesion.php" class="boton" style="margin-top: 20px;">Cerrar Sesión</a>
    </div>
</body>
</html>


