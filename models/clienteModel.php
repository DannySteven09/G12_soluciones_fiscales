<?php
require_once '../config/conexion.php';

class ClienteModel {
    // Obtener todos los clientes
    public static function getClientes() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM clientes";
        $resultado = $conexion->query($sql);
        $clientes = $resultado->fetch_all(MYSQLI_ASSOC);

        $conexion->close();
        return $clientes;
    }

    // Insertar un nuevo cliente
    public static function insertarCliente($nombre, $cedula, $correo, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO clientes (nombre, cedula, correo, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $cedula, $correo, $telefono);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Actualizar un cliente existente
    public static function actualizarCliente($id_cliente, $nombre, $cedula, $correo, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE clientes SET nombre = ?, cedula = ?, correo = ?, telefono = ? WHERE id_cliente = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $cedula, $correo, $telefono, $id_cliente);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }

    // Eliminar un cliente
    public static function eliminarCliente($id_cliente) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $resultado;
    }
}
?>
