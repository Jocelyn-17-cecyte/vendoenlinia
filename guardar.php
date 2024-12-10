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
        $guardado = false;

        // Verificar si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $precio = $_POST['precio'] ?? '';
            $imagen = $_FILES['url_img'] ?? null;

            // Validar los campos requeridos
            if (empty($nombre) || empty($precio) || !$imagen) {
                die("Todos los campos son obligatorios.");
            }

            // Procesar la imagen
            $directorio = 'img/';
            $nombreArchivo = basename($imagen['name']);
            $rutaArchivo = $directorio . $nombreArchivo;

            // Verificar si el archivo es una imagen válida
            $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
            $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($tipoArchivo, $extensionesPermitidas)) {
                die("Solo se permiten archivos JPG, JPEG, PNG y GIF.");
            }

            // Mover el archivo subido a la carpeta img
            if (!move_uploaded_file($imagen['tmp_name'], $rutaArchivo)) {
                die("Error al subir la imagen.");
            }

            // Guardar los datos en la base de datos
            $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, url_img) VALUES (?, ?, ?)");
            $stmt->bind_param("sds", $nombre, $precio, $rutaArchivo);

            if ($stmt->execute()) {
                $guardado = true;
            } 
            // Cerrar la conexión y la declaración
            $stmt->close();
            $conn->close();
        }

    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <?php 

        if ($guardado) {
            echo "<h4>Producto guardado correctamente.</h4>";
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
