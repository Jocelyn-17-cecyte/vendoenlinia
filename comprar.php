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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los productos del carrito enviados en el formulario
            $productos = json_decode($_POST['productos'], true); // Decodificar el JSON
        
            // Verificar si los productos están bien recibidos
            if (is_array($productos) && count($productos) > 0) {
                // Conectar a la base de datos (asegúrate de incluir tu archivo de conexión)
                        
                // Insertar cada producto en la tabla 'ventas'
                foreach ($productos as $producto) {
                    // Verificar si el producto tiene un 'id' y no está vacío
                    if (isset($producto['id']) && !empty($producto['id'])) {
                        $id_producto = $producto['id'];
                        $fecha = date('Y-m-d H:i:s'); // Fecha y hora actuales
        
                        // Insertar la venta en la base de datos
                        $sql = "INSERT INTO ventas (id_producto, fecha) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('is', $id_producto, $fecha);
        
                        // Ejecutar la consulta
                        if ($stmt->execute()) {
                            // echo "Venta registrada correctamente para el producto ID: $id_producto<br>";
                        } else {
                            // echo "Error al registrar la venta para el producto ID: $id_producto. Error: " . $stmt->error . "<br>";
                        }
                    } else {
                        // echo "Error: El producto no tiene un 'id' válido.<br>";
                    }
                }
        
                // Cerrar la conexión
                $conn->close();
            } else {
                echo "No se encontraron productos para la compra.";
            }
        }
    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <h4>La compra se efectuo correctamente.</h4>
        <a class= 'btn btn-primary' href='productos.php'>Seguir comprando</a>    
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
