<?php
require_once "conexion.php";

class Usuario {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conexion;
    }

    public function registrar($nombre, $email, $password) {
        $verificar = $this->conexion->query("SELECT * FROM usuarios WHERE correo='$email'");
        if ($verificar->num_rows > 0) {
            return "El usuario ya está registrado.";
        }

        // Insertar usuario sin cifrado (solo para entorno local)
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$email', '$password')";
        if ($this->conexion->query($sql)) {
            return "Registro exitoso.";
        } else {
            return "Error al registrar usuario.";
        }
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE correo='$email' AND contrasena='$password'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            session_start();
            $_SESSION['usuario'] = $email;
            return "Login exitoso.";
        } else {
            return "Usuario o contraseña incorrectos.";
        }
    }
}
?>