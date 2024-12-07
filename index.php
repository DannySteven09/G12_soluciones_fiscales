<?php
session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['usuario'])) {
    // Redirigir al overview si el usuario ya está logueado
    header('Location: views/overview.php');
    exit();
} else {
    // Redirigir al login si no hay sesión activa
    header('Location: views/login.php');
    exit();
}
?>
