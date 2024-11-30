<?php
require_once '../includes/db_connection.php';

class CitaModel {
    public static function insertCita($data) {
        try {
            $sql = "INSERT INTO citas (id_cliente, fecha_hora, descripcion, estado) VALUES (
                {$data['id_cliente']},
                '{$data['fecha_hora']}',
                '{$data['descripcion']}',
                '{$data['estado']}'
            )";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getCitas() {
        try {
            $sql = "SELECT citas.*, clientes.nombre AS cliente_nombre 
                    FROM citas
                    INNER JOIN clientes ON citas.id_cliente = clientes.id_cliente";
            $resultado = conexionBD::getData($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function updateCita($id, $data) {
        try {
            $sql = "UPDATE citas SET
                id_cliente = {$data['id_cliente']},
                fecha_hora = '{$data['fecha_hora']}',
                descripcion = '{$data['descripcion']}',
                estado = '{$data['estado']}'
                WHERE id_cita = $id";

            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function deleteCita($id) {
        try {
            $sql = "DELETE FROM citas WHERE id_cita = $id";
            $resultado = conexionBD::execute($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
