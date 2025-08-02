<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM LOGIN WHERE usuarios = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $fila = $result->fetch_assoc();
        $contrasena = $fila['contraseña'];

        if ($contrasena === $contrasena) {
            $_SESSION['usuario'] = $fila['usuarios'];
            $_SESSION['rol'] = $fila['rol'];
            header("Location: panel.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}
$conn->close();
?>
