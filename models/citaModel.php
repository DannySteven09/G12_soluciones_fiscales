<?php
require_once '../config/conexion.php';

class CitaModel {
    // Obtener todas las citas
    public static function getCitas() {
        $conexion = Conexion::conectar();
        $sql = "SELECT citas.id_cita, citas.fecha_hora, citas.descripcion, citas.estado, clientes.nombre AS cliente
                FROM citas
                INNER JOIN clientes ON citas.id_cliente = clientes.id_cliente";
        $resultado = $conexion->query($sql);
        $citas = $resultado->fetch_all(MYSQLI_ASSOC);

        $conexion->close();
        return $citas;
    }

    // Insertar una nueva cita
    public static function insertarCita($id_cliente, $fecha_hora, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO citas (id_cliente, fecha_hora, descripcion, estado) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isss", $id_cliente, $fecha_hora, $descripcion, $estado);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Actualizar una cita existente
    public static function actualizarCita($id_cita, $id_cliente, $fecha_hora, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE citas SET id_cliente = ?, fecha_hora = ?, descripcion = ?, estado = ? WHERE id_cita = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isssi", $id_cliente, $fecha_hora, $descripcion, $estado, $id_cita);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Eliminar una cita
    public static function eliminarCita($id_cita) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM citas WHERE id_cita = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_cita);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }
}
?>
