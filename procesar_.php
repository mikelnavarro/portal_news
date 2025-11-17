<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal_noticias";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
} else {
    header('Location: registro.php');
    exit;
}

$verificar = $conn->query("SELECT * FROM usuarios WHERE correo='$correo'");
if ($verificar->num_rows > 0) {
    return "El usuario ya está registrado.";
}


// Insertar usuario sin cifrado (solo para entorno local)
$sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
// Ejecutar la consulta
if ($sql) {
    header('Location: registro.html?status=ok');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;    
}
// Cerrar la conexión
$conn->close();
?>