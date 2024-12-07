<?php
require_once '../config/conexion.php';

class ServicioController {
    public static function obtenerServicios() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM servicios";
        $resultado = $conexion->query($sql);

        $servicios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $servicios[] = $fila;
        }

        $conexion->close();
        return $servicios;
    }

    public static function agregarServicio($nombre, $descripcion, $precio) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO servicios (nombre, descripcion, precio) VALUES (?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function editarServicio($id, $nombre, $descripcion, $precio) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id_servicio = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function eliminarServicio($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM servicios WHERE id_servicio = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }
}
?>
