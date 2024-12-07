<?php
require_once '../controllers/servicioController.php';
$servicios = ServicioController::listarServicios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2 class="header-title">Gestión de Servicios</h2>
        <a href="form-servicio.php" class="btn btn-primary">Agregar Servicio</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Fecha de Contratación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?php echo $servicio['id_servicio']; ?></td>
                    <td><?php echo $servicio['cliente']; ?></td>
                    <td><?php echo $servicio['nomb
<?php
require_once '../controllers/servicioController.php';
require_once '../controllers/clienteController.php';

$servicio = null;
$clientes = ClienteController::listarClientes();

if (isset($_GET['id'])) {
    $servicio = ServicioController::obtenerServicioPorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Servicio</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2><?php echo isset($servicio) ? 'Editar Servicio' : 'Agregar Servicio'; ?></h2>
        <form method="POST" action="../controllers/servicioController.php?action=<?php echo isset($servicio) ? 'editar' : 'agregar'; ?>">
            <?php if (isset($servicio)): ?>
                <input type="hidden" name="id" value="<?php echo $servicio['id_servicio']; ?>">
            <?php endif; ?>

            <label for="id_cliente">Cliente:</label>
            <select id="id_cliente" name="id_cliente" required>
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo (isset($servicio) && $servicio['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>>
                        <?php echo $cliente['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="nombre_servicio">Nombre del Servicio:</label>
            <input type="text" id="nombre_servicio" name="nombre_servicio" value="<?php echo $servicio['nombre_servicio'] ?? ''; ?>" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Activo" <?php echo (isset($servicio) && $servicio['estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                <option value="Inactivo" <?php echo (isset($servicio) && $servicio['estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
            </select>

            <label for="fecha_contratacion">Fecha de Contratación:</label>
            <input type="date" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo $servicio['fecha_contratacion'] ?? ''; ?>" required>

            <button type="submit"><?php echo isset($servicio) ? 'Actualizar' : 'Guardar'; ?></button>
        </form>
    </main>
</body>
</html>
<a href="gestion-servicios.php">
    <i class="fas fa-tools"></i> Gestión de Servicios
</a>
