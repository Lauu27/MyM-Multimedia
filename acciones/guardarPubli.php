<?php

session_start();
require_once('../conexion.php');

if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Debes estar logueado para crear una publicación.'); window.location.href = '../login.php';</script>";
    exit();
}

if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_FILES['foto']) && isset($_POST['id_categoria'])) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $id_categoria = $_POST['id_categoria'];

    $categorias = [
        1 => 'motion',
        2 => 'photoshop',
        3 => 'illustrator',
        4 => 'modelado'
    ];

    if (!isset($categorias[$id_categoria])) {
        $_SESSION['error'] = 'Categoría no válida.';
        echo "<script>window.location.href = '../publi.php';</script>";
        exit;
    }

    $categoria_nombre = $categorias[$id_categoria];

    $foto = $_FILES['foto'];
    $foto_tmp = $foto['tmp_name'];
    $foto_nombre = $foto['name'];
    $foto_extension = strtolower(pathinfo($foto_nombre, PATHINFO_EXTENSION));

    $extensiones_validas = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

    if (!in_array($foto_extension, $extensiones_validas)) {
        $_SESSION['error'] = 'Solo se pueden subir imágenes (jpg, jpeg, png, gif, bmp).';
        echo "<script>window.location.href = '../publi.php';</script>";
        exit;
    }

    $foto_nueva = uniqid() . '.' . $foto_extension;

    $ruta_categoria = $_SERVER['DOCUMENT_ROOT'] . '/tiendamica/images/' . $categoria_nombre;

    if (!file_exists($ruta_categoria)) {
        mkdir($ruta_categoria, 0777, true);
    }

    $ruta_imagen = $ruta_categoria . '/' . $foto_nueva;

    if (move_uploaded_file($foto_tmp, $ruta_imagen)) {
        $sql = "INSERT INTO productos (nombre, descripcion, foto, id_categoria) 
                VALUES ('$nombre', '$descripcion', '$ruta_imagen', '$id_categoria')";
        
        if (mysqli_query($conexion, $sql)) {
            $_SESSION['success'] = 'Publicación creada exitosamente.';
            echo "<script>window.location.href = '../publi.php';</script>";
        } else {
            $_SESSION['error'] = 'Error al guardar los datos en la base de datos.';
            echo "<script>window.location.href = '../publi.php';</script>";
        }
    } else {
        $_SESSION['error'] = 'Error al subir la imagen.';
        echo "<script>window.location.href = '../publi.php';</script>";
    }
} else {
    $_SESSION['error'] = 'Todos los campos son obligatorios.';
    echo "<script>window.location.href = '../publi.php';</script>";
}

?>
