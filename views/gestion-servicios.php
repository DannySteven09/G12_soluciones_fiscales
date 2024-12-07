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
                    <td><?php echo htmlspecialchars($servicio['cliente']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['nombre_servicio']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['estado']); ?></td>
                    <td><?php echo htmlspecialchars($servicio['fecha_contratacion']); ?></td>
                    <td>
                        <a href="form-servicio.php?id=<?php echo $servicio['id_servicio']; ?>" class="btn btn-edit">Editar</a>
                        <a href="../controllers/servicioController.php?action=eliminar&id=<?php echo $servicio['id_servicio']; ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este servicio?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
