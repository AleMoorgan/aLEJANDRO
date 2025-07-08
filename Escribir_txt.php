<?php
//obtener el texto ingresado por el user
$texto=$_GET["texto"];
//especifica el nombre y la ruta del arrchibo a sobrescrinir
$archivo = "texto.txt";
//sobrescribir el contenudo del arcgibo con el texto ingresado
file_put_contents($archivo, $texto);
//imprimir un mensaje
echo "Se ha sobrescrito el arcivo con el texto: $texto";
?>