<?php
include("conexion.php");

$mensaje = '';
$color = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    $rol = 'usuario'; // Por defecto

    // Verificar si ya existe el usuario
    $stmt = $conn->prepare("SELECT * FROM LOGIN WHERE usuarios = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $mensaje = "El nombre de usuario ya está en uso.";
        $color = 'error';
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO LOGIN (usuarios, contraseña, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $contrasena, $rol);

        if ($stmt->execute()) {
            $mensaje = "Usuario registrado correctamente.";
            $color = 'success';
        } else {
            $mensaje = "Error al registrar usuario.";
            $color = 'error';
        }
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
<title>Registro Armería RDR2</title>
<style>
  body {
    background: #3b2f2f;
    font-family: 'Georgia', serif;
    color: #f4f1e9;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
  }
  .login-container {
    background: #422f2f;
    padding: 30px 40px;
    border: 3px solid #7b5e57;
    box-shadow: 0 0 20px #7b5e57;
    width: 340px;
    border-radius: 12px;
  }
  .login-container h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
    color: #d9c4a3;
    letter-spacing: 3px;
  }
  label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #c9b799;
  }
  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: none;
    border-radius: 6px;
    background: #5a4a42;
    color: #f4f1e9;
    font-size: 16px;
    box-sizing: border-box;
  }
  input[type="submit"] {
    width: 100%;
    background: #a97855;
    border: none;
    padding: 12px;
    font-size: 18px;
    font-weight: 700;
    color: #3b2f2f;
    cursor: pointer;
    border-radius: 6px;
    transition: background 0.3s ease;
  }
  input[type="submit"]:hover {
    background: #d9c4a3;
  }
  .footer {
    margin-top: 15px;
    font-size: 12px;
    text-align: center;
    color: #7b5e57;
  }
  .error {
    background: #8b0000;
    color: #fff;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    font-weight: bold;
    text-align: center;
  }
  .success {
    background: #228B22;
    color: #fff;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    font-weight: bold;
    text-align: center;
  }
</style>
</head>
<body>

<div class="login-container">
  <h1>REGISTRO</h1>

  <?php if (!empty($mensaje)): ?>
    <div class="<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($mensaje) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" required autocomplete="off" />

    <label for="contrasena">Contraseña</label>
    <input type="password" id="contrasena" name="contrasena" required />

    <input type="submit" value="Registrarse" />
  </form>
  <div class="footer"><a href="index.php" style="color: #c9b799; text-decoration: underline;">Volver al login</a></div>
</div>

</body>
</html>
