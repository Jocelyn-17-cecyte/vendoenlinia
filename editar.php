<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendoenlinia</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body>

    <?php
        // Incluir la conexión
        include 'conexion.php';

        // Verificar si se ha enviado un ID a través de GET
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']); // Sanitizar el ID para evitar inyecciones SQL

            // Consultar la base de datos para obtener los detalles del producto
            $sql = "SELECT * FROM productos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si el producto existe
            if ($result->num_rows > 0) {
                // Obtener el producto
                $producto = $result->fetch_assoc();
            } else {
                die("Producto no encontrado.");
            }
        } else {
            die("No se ha proporcionado un ID de producto.");
        }

    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <h2>Editar Producto</h2>
        <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $producto['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="<?= $producto['precio'] ?>" required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" class="form-control-file">
                <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la imagen.</small>
            </div>

            <div class="form-group">
                <img src="<?= BASE_URL . '/' . $producto['url_img'] ?>" alt="Imagen actual" class="img-thumbnail" width="150">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </main>
    <br>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>&copy; 2024 Vendoenlinia. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.x.com" target="_blank" aria-label="X (Twitter)"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <!-- jQuery, Bootstrap JS -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-tienda.js"></script>
</body>
</html>
