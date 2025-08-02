<?php
session_start(); // Inicia la sesión si aún no está iniciada
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al login u otra página principal
header("Location: index.php");
exit;
?>
