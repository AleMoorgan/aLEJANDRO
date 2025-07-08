<?php
// Configuración de la conexión
$servername = "sql309.infinityfree.com";
$username   = "if0_38973681";
$password   = "a2YUPxdN0w8";
$dbname     = "if0_38973681_alejandro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: comentar esta línea en producción
// echo "Conexión exitosa";
?>
