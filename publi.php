<?php
session_start();
require_once('html/nav.php');
require_once('html/header.php');

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';

unset($_SESSION['error']);
unset($_SESSION['success']);
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Crear Nueva Publicación</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form action="acciones/guardarPubli.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto del Producto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                <option value="1">Motion Graphics</option>
                <option value="2">Photoshop</option>
                <option value="3">Illustrator</option>
                <option value="4">Modelado 3D</option>
            </select>
        </div>

        <button type="submit" class="btn btn-secondary w-100" style="margin-bottom: 20px;">Crear Publicación</button>
    </form>
</main>


<?php
require_once('html/footer.php');
?>
