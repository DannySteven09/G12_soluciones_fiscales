<?php
require_once '../controllers/clienteController.php';
$clientes = ClienteController::listarClientes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2 class="header-title">Gestión de Clientes</h2>
        <a href="form-cliente.php" class="btn btn-primary">Agregar Cliente</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id_cliente']; ?></td>
                    <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['cedula']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                    <td>
                        <a href="form-cliente.php?id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-edit">Editar</a>
                        <a href="../controllers/clienteController.php?action=eliminar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
