<?php
session_start();
require_once '../models/loginModel.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $loginModel = new loginModel();
        $usuario = $loginModel->validarUsuario($correo, $password);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            header('Location: ../views/overview.php');
        } else {
            header('Location: ../views/login.php?error=Credenciales incorrectas');
        }
        break;

    case 'logout':
        session_destroy();
        header('Location: ../views/login.php');
        break;

    default:
        header('Location: ../views/login.php');
        break;
}
?>
<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: overview.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="login-container">
        <h2 class="login-title">Iniciar Sesión</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="../controllers/loginController.php?action=login" method="POST">
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </main>
</body>
</html>
<?php
session_start();
session_destroy();
header('Location: login.php');
exit();
?>
