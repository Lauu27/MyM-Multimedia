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

if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];
    $sql = "SELECT id_producto, productos.nombre, descripcion, foto, productos.id_categoria, categorias.nombre AS categoria
            FROM productos
            INNER JOIN categorias ON categorias.id_categoria = productos.id_categoria
            WHERE productos.id_categoria = $id_categoria";
} else {
    $sql = "SELECT id_producto, productos.nombre, descripcion, foto, productos.id_categoria, categorias.nombre AS categoria
            FROM productos
            INNER JOIN categorias ON categorias.id_categoria = productos.id_categoria";
}

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<main class="container mt-4">
    <h2 class="text-center mb-4">Publicaciones</h2>
    <div class="d-flex justify-content-center">
        <a href="publi.php" class="btn btn-secondary mb-4">Crear Publicación</a>
    </div>
    <div class="row">
        <?php
        while ($producto = mysqli_fetch_assoc($resultado)) {
            $id_producto = $producto['id_producto'];
            $nombre_producto = $producto['nombre'];
            $foto = $producto['foto'];
            $categoria = $producto['categoria'];

            $extension = pathinfo($foto, PATHINFO_EXTENSION);

            echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>$nombre_producto</h5>";
            echo "<span class='badge text-bg-secondary'>$categoria</span><br>";

            echo "<div style='margin-top: 10px;'>";
            if (in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'webm'])) {
                echo "<video class='card-img-top' controls>
                        <source src='$foto' type='video/" . strtolower($extension) . "'>
                      </video>";
            } else {
                echo "<img src='$foto' class='card-img-top' alt='$nombre_producto'>";
            }
            echo "</div>";

            echo "<a href='detalle.php?id_producto=$id_producto' class='btn btn-secondary mt-2'>Ver más</a>";

            echo "  </div>
                  </div>
                </div>";
        }
        ?>
    </div>
</main>

<?php
require_once('html/footer.php');
?>
