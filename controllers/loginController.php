<?php
require_once '../config/conexion.php';

class LoginController {
    // Validar credenciales de usuario
    public static function validarUsuario($correo, $password) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM usuarios WHERE correo = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        $stmt->close();
        $conexion->close();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario; // Usuario válido
        } else {
            return false; // Credenciales incorrectas
        }
    }
}
?>
