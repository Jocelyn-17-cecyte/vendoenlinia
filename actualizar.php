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
        $actualizado = false;

        // Verificar si el formulario fue enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir los datos del formulario
            $id = intval($_POST['id']);  // Sanitizar el ID para evitar inyecciones SQL
            $nombre = $_POST['nombre'];
            $precio = floatval($_POST['precio']);
            $imagen = $_FILES['imagen'];

            // Validar los datos
            if (empty($nombre) || empty($precio)) {
                echo "El nombre y el precio son campos obligatorios.";
                exit;
            }

            // Verificar si se cargó una nueva imagen
            if ($imagen['error'] == 0) {
                // Procesar la nueva imagen
                $imagen_nombre = time() . '_' . $imagen['name'];
                $imagen_ruta = 'img/' . $imagen_nombre;

                // Mover la imagen a la carpeta de imágenes
                if (move_uploaded_file($imagen['tmp_name'], $imagen_ruta)) {
                    // Si la imagen se cargó correctamente, actualizar la URL de la imagen en la base de datos
                    $sql = "UPDATE productos SET nombre = ?, precio = ?, url_img = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sdsi", $nombre, $precio, $imagen_ruta, $id);
                } else {
                    echo "Error al cargar la imagen.";
                    exit;
                }
            } else {
                // Si no se cargó una nueva imagen, solo actualizar el nombre y precio
                $sql = "UPDATE productos SET nombre = ?, precio = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdi", $nombre, $precio, $id);
            }

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $actualizado = true;
            } else {
                echo "Error al actualizar el producto: " . $conn->error;
            }
        }

    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <?php 

        if ($actualizado) {
            echo "<h4>Producto actualizado correctamente.</h4>";
            echo "<a class= 'btn btn-primary' href='index.php'>Ir al inicio</a>";
            echo "<br><br>";
            echo "<a class= 'btn btn-primary' href='crear.php'>Ingresar nuevo</a>";
        }

        ?>
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
