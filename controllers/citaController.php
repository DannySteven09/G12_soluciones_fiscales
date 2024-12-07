<?php
require_once '../config/conexion.php';

class CitaController {
    public static function obtenerCitas() {
        $conexion = Conexion::conectar();
        $sql = "SELECT c.id_cita, c.fecha_hora, c.descripcion, c.estado, cl.nombre AS cliente 
                FROM citas c 
                INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente";
        $resultado = $conexion->query($sql);

        $citas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $citas[] = $fila;
        }

        $conexion->close();
        return $citas;
    }

    public static function agregarCita($id_cliente, $fecha_hora, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO citas (id_cliente, fecha_hora, descripcion, estado) VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isss", $id_cliente, $fecha_hora, $descripcion, $estado);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function editarCita($id, $id_cliente, $fecha_hora, $descripcion, $estado) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE citas SET id_cliente = ?, fecha_hora = ?, descripcion = ?, estado = ? WHERE id_cita = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isssi", $id_cliente, $fecha_hora, $descripcion, $estado, $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function eliminarCita($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM citas WHERE id_cita = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }
}
?>
