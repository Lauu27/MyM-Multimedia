<?php

session_start();

require_once('../conexion.php');

if (isset($_POST['email']) && isset($_POST['clave'])) {
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $clave = md5($clave);

    $sql = "SELECT id_usuario, id_rol, nombre, clave
            FROM usuarios
            WHERE email = '$email' AND clave = '$clave'";

    $resultado = mysqli_query($conexion, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['id_rol'] = $usuario['id_rol'];

        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Credenciales incorrectas, por favor intenta nuevamente.';
        header('Location: ../login.php');
        exit;
    }
}

?>
