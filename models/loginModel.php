<?php
require_once '../config/conexion.php';

class LoginModel {
    public static function validarUsuario($correo) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        $stmt->close();
        $conexion->close();

        return $usuario;
    }
}
?>
<?php
require_once '../config/conexion.php';

class LoginModel {
    public static function validarUsuario($correo, $password) {
        try {
            $conexion = Conexion::conectar();
            $sql = "SELECT * FROM usuarios WHERE correo = ?";
            $stmt = $conexion->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error en la preparación del statement: " . $conexion->error);
            }

            $stmt->bind_param("s", $correo);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();

            $stmt->close();
            $conexion->close();

            // Verificamos si el usuario existe y si la contraseña es correcta
            if ($usuario && password_verify($password, $usuario['password'])) {
                return $usuario; // Usuario válido
            }

            return false; // Usuario no válido o contraseña incorrecta
        } catch (Exception $e) {
            error_log("Error en validarUsuario: " . $e->getMessage());
            return false;
        }
    }
}
?>
