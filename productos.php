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
        $sql = "SELECT id, nombre, precio, url_img FROM productos";
        $result = $conn->query($sql);
    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <div class="banner">
        <h3>¡Grandes Rebajas en nuestros productos! ¡No te lo pierdas!</h3>
    </div>


    <!-- Body -->
    <main class="container mt-5">
        <h2 class="text-center mb-4">Productos Disponibles</h2>

        <!-- Fila de productos -->
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '  <div class="card">';
                    echo '    <img src="' . BASE_URL . '/' . $row['url_img'] . '" class="card-img-top" alt="Imagen de ' . $row['nombre'] . '">';
                    echo '    <div class="card-body">';
                    echo '      <h5 class="card-title">' . $row['nombre'] . '</h5>';
                    echo '      <p class="card-text">$' . number_format($row['precio'], 2) . '</p>';
                    echo '      <form action="agregar_carrito.php" method="POST">';
                    echo '        <input type="hidden" name="id_producto" value="' . $row['id'] . '">';
                    echo '        <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Agregar al carrito</button>';
                    echo '      </form>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay productos disponibles.</p>';
            }
            ?>
        </div>

        <!-- Carrito de compras -->
        <div class="mt-5">
            <h3>Carrito de Compras</h3>
            <ul id="carrito" class="list-group">
                <!-- Aquí se agregarán los productos seleccionados -->
            </ul>
            <div class="mt-3">
                <strong>Total: $<span id="total">0.00</span></strong>
            </div>
            <!-- Formulario para procesar la compra -->
            <form action="comprar.php" method="POST" id="compra-form">
                <input type="hidden" name="productos" id="productos" value=""> <!-- Productos en formato JSON -->
                <button type="submit" class="btn btn-success mt-3">Finalizar Compra</button>
            </form>
        </div>
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
     <script>
        document.querySelector('form#compra-form').addEventListener('submit', function(e) {
            e.preventDefault();  // Evita que el formulario se envíe antes de actualizar el campo
        
            // Asegurarse de que el carrito no esté vacío
            if (carrito.length > 0) {
                // Convertir el carrito a formato JSON
                const productosJSON = JSON.stringify(carrito);
        
                // Establecer el valor del campo oculto 'productos' con el JSON
                document.getElementById('productos').value = productosJSON;
        
                // Enviar el formulario
                this.submit();
            } else {
                alert("El carrito está vacío.");
            }
        });
     </script>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-tienda.js"></script>
</body>
</html>
