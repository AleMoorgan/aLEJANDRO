<?php
// Activar reporte de errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

// Obtener el rol del usuario
$usuario = $_SESSION['usuario'];
$stmt = $conn->prepare("SELECT rol FROM LOGIN WHERE usuarios = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();

if (!$datos) {
    echo "Error: usuario no encontrado en la base de datos.";
    exit();
}

$rol = $datos['rol'] ?? 'usuario'; // Por defecto "usuario" si no hay rol

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel - Armería RDR2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2d2d2d;
            color: #fff;
            padding: 20px;
        }
        h1 { color: #d9c4a3; }
        a { color: #a97855; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .boton {
            padding: 10px 15px;
            margin: 5px;
            background: #a97855;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
        }
        .boton:hover {
            background: #d9c4a3;
            color: #000;
        }
    </style>
</head>
<body>

<h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h1>
<p>Rol: <strong><?php echo htmlspecialchars($rol); ?></strong></p>

<?php if ($rol === 'admin'): ?>
    <h2>Panel de Administración</h2>
    <a href="agregar_arma.php" class="boton">Agregar Arma</a>
    <a href="modificar_arma.php" class="boton">Modificar Arma</a>
    <a href="borrar_arma.php" class="boton">Borrar Arma</a>
<?php else: ?>
    <h2>Catálogo de Armas</h2>
    <a href="comprar.php" class="boton">Comprar Armas</a>
<?php endif; ?>

<br><br>
<a href="logout.php" class="boton">Cerrar sesión</a>

</body>
</html>
