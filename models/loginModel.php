<?php
require_once '../includes/db_connection.php';

class UsuarioModel {
    public static function insertUsuario($data) {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $sql = "INSERT INTO usuarios (nombre_usuario, correo, password) VALUES (
                '{$data['nombre_usuario']}',
                '{$data['correo']}',
                '{$hashedPassword}'
            )";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getUsuarios() {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, correo, fecha_creacion FROM usuarios";
            $resultado = conexionBD::getData($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getUsuarioById($id) {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, correo, fecha_creacion FROM usuarios WHERE id_usuario = $id";
            $resultado = conexionBD::getData($sql);
            return $resultado ? $resultado[0] : null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function updateUsuario($id, $data) {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET
                nombre_usuario = '{$data['nombre_usuario']}',
                correo = '{$data['correo']}',
                password = '{$hashedPassword}'
                WHERE id_usuario = $id";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function deleteUsuario($id) {
        try {
            $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function authenticateUsuario($nombre_usuario, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '{$nombre_usuario}'";
            $resultado = conexionBD::getData($sql);

            if ($resultado) {
                $usuario = $resultado[0];
                if (password_verify($password, $usuario['password'])) {
                    return $usuario;
                }
            }
            return null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
