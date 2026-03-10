<?php

session_start();
require_once('conexion.php');
require_once('html/nav.php');
require_once('html/header.php');

if (isset($_SESSION['id_usuario'])) {
    $usuario_logueado = true;
    $nombre = $_SESSION['nombre'];
} else {
    $usuario_logueado = false;
}

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
} else {
    die('Error: No se proporcionó el id_producto');
}

$sql = "SELECT productos.nombre, foto, descripcion, productos.id_categoria, categorias.nombre AS categoria
        FROM productos
        INNER JOIN categorias ON categorias.id_categoria = productos.id_categoria
        WHERE id_producto = $id_producto";

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die('Error en la consulta SQL: ' . mysqli_error($conexion));
}

$producto = mysqli_fetch_assoc($resultado);

if (!$producto) {
    die('Producto no encontrado');
}

$nombre = $producto['nombre'];
$foto = $producto['foto'];
$categoria = $producto['categoria'];
$descripcion = $producto['descripcion'];

$sqlComentarios =  "SELECT c.id_comentario, c.fecha, c.meGusta, c.detalle, u.nombre
                    FROM comentarios c
                    INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
                    WHERE c.id_producto = $id_producto";
$resultadoComentarios = mysqli_query($conexion, $sqlComentarios);

?>

<main class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-6">
            <?php
            $extension = pathinfo($foto, PATHINFO_EXTENSION);

            echo "<div class='media-container' style='max-width: 100%; max-height: 500px; overflow: hidden; border: 1px solid #ddd; border-radius: 10px;'>";

            if (in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'webm'])) {
                echo "<video class='d-block w-100' controls style='max-height: 500px; object-fit: contain;'>
                        <source src='$foto' type='video/" . strtolower($extension) . "'>
                      </video>";
            } else {
                echo "<img src='$foto' class='d-block w-100' alt='$nombre' style='max-height: 500px; object-fit: contain;'>";
            }
            echo "</div>";
            ?>
        </div>

        <div class="col-md-6">
            <h2> <?php echo($nombre); ?> </h2>
            <h4> <span class="badge text-bg-secondary"><?php echo($categoria); ?></span> </h4>
            <p><strong>Descripción:</strong> <?php echo($descripcion); ?></p>
            <hr>
            <h4>Comentarios</h4>
            <ul class="list-group">
                <?php
                while ($comentario = mysqli_fetch_assoc($resultadoComentarios)) {
                    $id_comentario = $comentario['id_comentario'];
                    $detalle = $comentario['detalle'];
                    $meGusta = $comentario['meGusta'];
                    $nombre_usuario = $comentario['nombre'];
                    echo "<li class='list-group-item'>
                            <strong>$nombre_usuario:</strong> $detalle
                            <span class='badge text-bg-success'>$meGusta</span>
                            <a href='acciones/darMeGusta.php?id_producto=$id_producto&id_comentario=$id_comentario&meGusta=$meGusta'>
                                <i class='fa-solid fa-heart text-danger'></i>
                            </a>   
                          </li>";
                }
                ?>
            </ul>
            <?php
            if (isset($_SESSION['id_usuario'])) {
            ?>
                <form action="acciones/guardarComentario.php?id_producto=<?php echo($id_producto); ?>" method="post" class="p-3">
                    <textarea class="form-control" name="detalle" cols="30" rows="4"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Publicar</button>
                </form>
            <?php
            } else {
            ?>
                <div class="alert alert-danger mt-4"> Para comentar es necesario iniciar sesión. </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php

require_once('html/footer.php');

?>
