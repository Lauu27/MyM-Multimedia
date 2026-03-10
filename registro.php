<?php
session_start();
require_once('html/nav.php');
require_once('html/header.php');

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

unset($_SESSION['error']);
?>

<main class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-6 p-4">
            <form action="acciones/usuarioRegistrar.php" method="POST" class="p-4">
                <h2 class="text-center">REGISTRARSE</h2>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" class="form-control" type="text" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input name="email" class="form-control" type="email" required>
                </div>

                <div class="mb-3">
                    <label for="clave">Contraseña</label>
                    <input name="clave" class="form-control" type="password" required>
                </div>

                <button class="btn btn-secondary w-100" type="submit">Registrarme</button>
            </form>
        </div>

        <div class="col-md-6 p-0">
            <img src="images/1.jpg" alt="Imagen" class="img-fluid" style="object-fit: cover; width: 100%; height: 100vh;">
        </div>
    </div>
</main>

<?php
require_once('html/footer.php');
?>
