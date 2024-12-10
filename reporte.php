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
        $sql = "SELECT p.id, p.nombre, p.precio, p.url_img, v.fecha 
        FROM vendoenlinia.productos p
        JOIN vendoenlinia.ventas v ON v.id_producto = p.id
        ORDER BY v.fecha DESC";
        $result = $conn->query($sql);

        // Inicializar variables
        $totalVentas = 0;
        $productosVendidos = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Acumulamos el total de ventas
                $totalVentas += $row['precio'];
                
                // Guardamos el producto y su información
                $productosVendidos[] = $row;
            }
        } else {
            echo "No hay ventas registradas.";
        }

        // Cerrar la conexión
        $conn->close();
    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
    <h2 class="text-center">Reporte de Ventas</h2>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los productos vendidos
            foreach ($productosVendidos as $producto) {
                echo "<tr>";
                echo "<td>" . $producto['id'] . "</td>";
                echo "<td>" . $producto['nombre'] . "</td>";
                echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
                echo "<td><img src='" . BASE_URL . "/" . $producto['url_img'] . "' alt='" . $producto['nombre'] . "' class='img-thumbnail' width='50'></td>";
                echo "<td>" . date('d/m/Y H:i:s', strtotime($producto['fecha'])) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h4 class="text-right">Total Ventas: $<?php echo number_format($totalVentas, 2); ?></h4>        
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
