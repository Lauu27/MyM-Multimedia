<?php

    session_start();
    require_once('../conexion.php');

    if( isset( $_POST['detalle']) && isset( $_GET['id_producto'])   ) {
  
        $detalle = $_POST['detalle'];
        $id_producto = $_GET['id_producto'];
        $id_usuario = $_SESSION['id_usuario'];
        $meGusta = 0;

        $sql = "INSERT INTO comentarios( fecha, meGusta, detalle, id_usuario, id_producto)
                VALUES( now() , $meGusta, '$detalle', $id_usuario, $id_producto)";

        $resultado = mysqli_query($conexion, $sql);
        header("Location: ../detalle.php?id_producto=$id_producto");

    } else {
        echo('<h2> Acceso incorrecto</h2>');
    }

?>