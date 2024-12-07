<?php
require_once '../controllers/clienteController.php';

// Verificar si se está editando un cliente existente
$cliente = null;
if (isset($_GET['id'])) {
    $cliente = ClienteController::obtenerClientePorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($cliente) ? 'Editar Cliente' : 'Agregar Cliente'; ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2><?php echo isset($cliente) ? 'Editar Cliente' : 'Agregar Cliente'; ?></h2>
        <form method="POST" action="../controllers/clienteController.php?action=<?php echo isset($cliente) ? 'editar' : 'agregar'; ?>">
            <?php if (isset($cliente)): ?>
                <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
            <?php endif; ?>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre'] ?? ''; ?>" required>

            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" value="<?php echo $cliente['cedula'] ?? ''; ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $cliente['correo'] ?? ''; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['telefono'] ?? ''; ?>" required>

            <button type="submit"><?php echo isset($cliente) ? 'Actualizar' : 'Guardar'; ?></button>
        </form>
    </main>
</body>
</html>
