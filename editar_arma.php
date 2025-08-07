<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

// Validar que llega el id por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de arma no especificado.";
    exit();
}

$id = intval($_GET['id']); // sanitizar

// Obtener datos del arma
$stmt = $conn->prepare("SELECT * FROM armas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Arma no encontrada.";
    exit();
}

$arma = $result->fetch_assoc();

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $tipo_bala = $_POST['tipo_bala'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? '';

    // Validar campos básicos
    if (empty($nombre) || empty($id_categoria)) {
        echo "El nombre y la categoría son obligatorios.";
    } else {
        // Actualizar en la base
        $stmt = $conn->prepare("UPDATE armas SET nombre = ?, descripcion = ?, precio = ?, tipo_bala = ?, id_categoria = ? WHERE id = ?");
        $stmt->bind_param("ssdiii", $nombre, $descripcion, $precio, $tipo_bala, $id_categoria, $id);
        if ($stmt->execute()) {
            echo "<p>Arma actualizada correctamente.</p>";
            // Actualizar $arma para mostrar los datos nuevos
            $arma['nombre'] = $nombre;
            $arma['descripcion'] = $descripcion;
            $arma['precio'] = $precio;
            $arma['tipo_bala'] = $tipo_bala;
            $arma['id_categoria'] = $id_categoria;
        } else {
            echo "<p>Error al actualizar el arma.</p>";
        }
    }
}

// Obtener categorías para el select
$cat_result = $conn->query("SELECT id, nombre FROM categorias");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Arma</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f3f3; padding: 20px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc;
        }
        button { margin-top: 20px; padding: 10px 15px; background: #a97855; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #d9c4a3; color: black; }
        a { display: block; margin-top: 20px; text-align: center; text-decoration: none; color: #a97855; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h1>Editar Arma: <?= htmlspecialchars($arma['nombre']) ?></h1>

    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($arma['nombre']) ?>">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"><?= htmlspecialchars($arma['descripcion']) ?></textarea>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" value="<?= htmlspecialchars($arma['precio']) ?>">

        <label for="tipo_bala">Tipo de Bala:</label>
        <input type="text" name="tipo_bala" id="tipo_bala" value="<?= htmlspecialchars($arma['tipo_bala']) ?>">

        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria" required>
            <option value="">-- Seleccione categoría --</option>
            <?php while ($cat = $cat_result->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>" <?= ($arma['id_categoria'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="listar_armas.php">⬅ Volver al inventario</a>

</body>
</html>
