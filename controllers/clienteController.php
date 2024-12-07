<?php
require_once '../config/conexion.php';

class ClienteController {
    public static function obtenerClientes() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM clientes";
        $resultado = $conexion->query($sql);

        $clientes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $clientes[] = $fila;
        }

        $conexion->close();
        return $clientes;
    }

    public static function agregarCliente($nombre, $cedula, $correo, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO clientes (nombre, cedula, correo, telefono) VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $cedula, $correo, $telefono);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function editarCliente($id, $nombre, $cedula, $correo, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE clientes SET nombre = ?, cedula = ?, correo = ?, telefono = ? WHERE id_cliente = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $cedula, $correo, $telefono, $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    public static function eliminarCliente($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $resultado;
    }
}
?>
