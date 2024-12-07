<?php
require_once '../controllers/citaController.php';
$citas = CitaController::listarCitas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2 class="header-title">Gestión de Citas</h2>
        <a href="form-cita.php" class="btn btn-primary">Agregar Cita</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha y Hora</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?php echo $cita['id_cita']; ?></td>
                    <td><?php echo $cita['cliente']; ?></td>
                    <td><?php echo $cita['fecha_hora']; ?></td>
                    <td><?php echo $cita['descripcion']; ?></td>
                    <td><?php echo $cita['estado']; ?></td>
                    <td>
                        <a href="form-cita.php?id=<?php echo $cita['id_cita']; ?>">Editar</a>
                        <a href="../controllers/citaController.php?action=eliminar&id=<?php echo $cita['id_cita']; ?>">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
<?php
require_once '../controllers/citaController.php';
require_once '../controllers/clienteController.php';

$cita = null;
$clientes = ClienteController::listarClientes();

if (isset($_GET['id'])) {
    $cita = CitaController::obtenerCitaPorId($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Cita</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <main class="content">
        <h2><?php echo isset($cita) ? 'Editar Cita' : 'Agregar Cita'; ?></h2>
        <form method="POST" action="../controllers/citaController.php?action=<?php echo isset($cita) ? 'editar' : 'agregar'; ?>">
            <?php if (isset($cita)): ?>
                <input type="hidden" name="id" value="<?php echo $cita['id_cita']; ?>">
            <?php endif; ?>

            <label for="id_cliente">Cliente:</label>
            <select id="id_cliente" name="id_cliente" required>
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo (isset($cita) && $cita['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>>
                        <?php echo $cliente['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_hora">Fecha y Hora:</label>
            <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="<?php echo $cita['fecha_hora'] ?? ''; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $cita['descripcion'] ?? ''; ?></textarea>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Pendiente" <?php echo (isset($cita) && $cita['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                <option value="Confirmada" <?php echo (isset($cita) && $cita['estado'] == 'Confirmada') ? 'selected' : ''; ?>>Confirmada</option>
                <option value="Cancelada" <?php echo (isset($cita) && $cita['estado'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
            </select>

            <button type="submit"><?php echo isset($cita) ? 'Actualizar' : 'Guardar'; ?></button>
        </form>
    </main>
</body>
</html>
