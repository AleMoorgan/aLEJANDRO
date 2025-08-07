<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

// Obtener categorías
$categorias = $conn->query("SELECT id, nombre FROM categorias");

// Guardar nueva arma si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);
    $imagen_url = $_POST['imagen_url'];
    $id_categoria = intval($_POST['id_categoria']);
    $tipo_bala = $_POST['tipo_bala'];

    $stmt = $conn->prepare("INSERT INTO armas (nombre, descripcion, precio, imagen_url, id_categoria, tipo_bala) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiss", $nombre, $descripcion, $precio, $imagen_url, $id_categoria, $tipo_bala);

    if ($stmt->execute()) {
        echo "<script>alert('Arma agregada exitosamente'); window.location.href='listar_armas.php';</script>";
    } else {
        echo "Error al agregar arma: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Arma</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f4f0e6;
            padding: 20px;
            color: #3a2c1a;
        }
        form {
            background-color: #fff8f0;
            border: 2px solid #a77b47;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #5a3e26;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background-color: #a77b47;
            color: white;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color: #d9c4a3;
            color: #000;
        }
    </style>
</head>
<body>
    <h2>Agregar Nueva Arma</h2>
    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required>

        <label>Categoría:</label>
        <select name="id_categoria" required>
            <?php while ($cat = $categorias->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Tipo de bala:</label>
        <input type="text" name="tipo_bala" required>

        <button type="submit">Agregar Arma</button>
    </form>
</body>
</html>

