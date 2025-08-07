<?php
include("conexion.php");

$id = $_GET["id"];
$stmt = $conn->prepare("DELETE FROM armas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: listar_armas.php");
exit();
