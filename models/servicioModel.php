<?php
require_once '../config/conexion.php';

class ServicioModel {
    // Obtener todos los servicios
    public static function getServicios() {
        $conexion = Conexion::conectar();
        $sql = "SELECT servicios.id_servicio, servicios.nombre_servicio, servicios.estado, servicios.fecha_contratacion, clientes.nombre AS cliente
                FROM servicios
                INNER JOIN clientes ON servicios.id_cliente = clientes.id_cliente";
        $resultado = $conexion->query($sql);
        $servicios = $resultado->fetch_all(MYSQLI_ASSOC);

        $conexion->close();
        return $servicios;
    }

    // Insertar un nuevo servicio
    public static function insertarServicio($id_cliente, $nombre_servicio, $estado, $fecha_contratacion) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO servicios (id_cliente, nombre_servicio, estado, fecha_contratacion) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isss", $id_cliente, $nombre_servicio, $estado, $fecha_contratacion);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Actualizar un servicio existente
    public static function actualizarServicio($id_servicio, $id_cliente, $nombre_servicio, $estado, $fecha_contratacion) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE servicios SET id_cliente = ?, nombre_servicio = ?, estado = ?, fecha_contratacion = ? WHERE id_servicio = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isssi", $id_cliente, $nombre_servicio, $estado, $fecha_contratacion, $id_servicio);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Eliminar un servicio
    public static function eliminarServicio($id_servicio) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM servicios WHERE id_servicio = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_servicio);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }
}
?>
