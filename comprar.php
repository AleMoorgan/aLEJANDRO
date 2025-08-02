<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
include("conexion.php");

$categorias = ["Revolveres", "Pistolas", "Rifles", "Escopetas", "Fusiles", "Municiones"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Armas - Armería RDR2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-image: url('imagenes/fondo_libro.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 20px;
            color: #3b2a1a;
        }
        .libro {
            background-color: rgba(255, 248, 235, 0.97);
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 3px solid #a77b47;
            border-radius: 15px;
            box-shadow: 0 0 15px #5e412f;
        }
        h1 {
            text-align: center;
            color: #5a3e26;
        }
        .categoria {
            margin: 20px 0;
        }
        .categoria a {
            display: block;
            background-color: #d3b58f;
            color: #000;
            text-decoration: none;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
            transition: 0.3s;
        }
        .categoria a:hover {
            background-color: #e2c6a2;
            transform: scale(1.02);
        }

        @media (max-width: 600px) {
            .libro {
                padding: 20px;
            }
            .categoria a {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="libro">
        <h1>Catálogo de Armas</h1>
        <div class="categoria">
            <?php foreach ($categorias as $cat): ?>
                <a href="categoria.php?tipo=<?php echo urlencode(strtolower($cat)); ?>">
                    <?php echo htmlspecialchars($cat); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <a href="panel.php" style="display:block; text-align:center; margin-top:20px;">⬅ Volver al Panel</a>
    </div>
</body>
</html>
