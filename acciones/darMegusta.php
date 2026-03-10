<?php

    require_once('../conexion.php');

    $id_producto = $_GET['id_producto'];
    $id_comentario = $_GET['id_comentario'];
    $meGusta = $_GET['meGusta'];

    $meGusta = $meGusta + 1;

    $sql = "UPDATE comentarios
            SET meGusta = $meGusta
            WHERE id_comentario = $id_comentario";
   
    $resultado = mysqli_query($conexion, $sql);
    header("Location: ../detalle.php?id_producto=$id_producto");

?>