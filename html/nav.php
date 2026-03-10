<?php
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $nombre = $_SESSION['nombre'];
} else {
    $nombre = null;
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand ms-2" href="index.php">
            <img src="images/icono.png" alt="MultiVerse Logo" style="height: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-2 mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="main.php">Publicaciones</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="main.php?id_categoria=1">Motion Graphics</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="main.php?id_categoria=2">Photoshop</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="main.php?id_categoria=3">Illustrator</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="main.php?id_categoria=4">Modelado 3D</a></li>
                    </ul>
                </li>
            </ul>

            <div class="dropdown ms-auto">
                <?php
                    if (isset($_SESSION['id_usuario'])) {
                ?>
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo($nombre); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                    </ul>
                <?php
                    } else {
                ?>
                    <a class="btn btn-secondary" href="registro.php">Registrarme</a>
                    <a class="btn btn-secondary ms-2" href="login.php">Iniciar sesión</a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</nav>
