<?php
require_once '../includes/db_connection.php';

class ClienteModel {
    public static function insertCliente($data) {
        try {
            $sql = "INSERT INTO clientes (nombre, cedula, correo, telefono) VALUES (
                '{$data['nombre']}',
                '{$data['cedula']}',
                '{$data['correo']}',
                '{$data['telefono']}'
            )";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getClientes() {
        try {
            $sql = "SELECT * FROM clientes";
            $resultado = conexionBD::getData($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function updateCliente($id, $data) {
        try {
            $sql = "UPDATE clientes SET
                nombre = '{$data['nombre']}',
                cedula = '{$data['cedula']}',
                correo = '{$data['correo']}',
                telefono = '{$data['telefono']}'
                WHERE id_cliente = $id";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function deleteCliente($id) {
        try {
            $sql = "DELETE FROM clientes WHERE id_cliente = $id";
            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
