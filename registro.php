<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "portal_noticias";
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
echo "Error de conexión: " . $conn->connect_error;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
}


// Verificar si el usuario está registrado en la BD
$verificar = $conn->query("SELECT * FROM usuarios WHERE correo='$correo'");
if ($verificar->num_rows > 0) {
return "El usuario ya está registrado.";
}

// Insertar usuario sin cifrado (solo para entorno local)
$sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
if ($conn->query($sql)) {
return "Registro exitoso.";
} else {
return "Error al registrar usuario.";
}

?>