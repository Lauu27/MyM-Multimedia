<?php

session_start();

require_once('../conexion.php');

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['clave'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $id_rol = 2;
    $clave = md5($clave);

    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado_check_email = mysqli_query($conexion, $sql_check_email);

    if (mysqli_num_rows($resultado_check_email) > 0) {
        $_SESSION['error'] = 'El correo electrónico ya está registrado.';
        header('Location: ../registro.php');
        exit;
    } else {
        $sql_insert = "INSERT INTO usuarios(id_rol, nombre, email, clave) VALUES($id_rol, '$nombre', '$email', '$clave')";

        $resultado_insert = mysqli_query($conexion, $sql_insert);

        if ($resultado_insert) {
            header('Location: ../login.php');
            exit;
        } else {
            $_SESSION['error'] = 'Hubo un error al registrar el usuario.';
            header('Location: ../registro.php');
            exit;
        }
    }
} else {
    $_SESSION['error'] = 'Por favor complete todos los campos.';
    header('Location: ../registro.php');
    exit;
}

?>
