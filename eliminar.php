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
        $eliminado = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']); // Asegurarse de que sea un número entero
        
            // Obtener la información del producto antes de eliminarlo
            $stmt = $conn->prepare("SELECT url_img FROM productos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($url_img);
            $stmt->fetch();
            $stmt->close();
        
            // Verificar si el producto existe
            if ($url_img) {
                // Eliminar el registro de la base de datos
                $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    // Intentar eliminar el archivo de imagen del servidor
                    $rutaArchivo = __DIR__ . '/' . $url_img;
                    if (file_exists($rutaArchivo)) {
                        unlink($rutaArchivo); // Eliminar el archivo
                    }
                    $eliminado = true;
                } else {
                    echo "Error al eliminar el producto: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "Solicitud inválida.";
        }
        
        // Cerrar la conexión a la base de datos
        $conn->close();      
        

    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <?php 

        if ($eliminado) {
            echo "<h4>Producto eliminado correctamente.</h4>";
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
