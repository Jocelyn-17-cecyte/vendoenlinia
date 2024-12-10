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
    ?>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Vendo en Línea </span>
    </nav>

    <!-- Body -->
    <main class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="d-inline-block">
                    <form action="reporte.php" method="post">
                        <button type="submit" class="btn btn-primary">
                        <i class="fas fa-clipboard-list"></i> Reporte de ventas
                        </button>
                    </form>
                </div>
                <div class="d-inline-block ml-2">
                    <form action="crear.php" method="post">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar producto
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta a la base de datos
                        $sql = "SELECT id, nombre, precio, url_img FROM productos";
                        $result = $conn->query($sql);

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Iterar sobre los resultados
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th scope='row'>{$row['id']}</th>";
                                echo "<td>{$row['nombre']}</td>";
                                echo "<td>$" . number_format($row['precio'], 2) . "</td>";
                                echo "<td><img src='" . BASE_URL . "/{$row['url_img']}' alt='Imagen de {$row['nombre']}' class='img-thumbnail' width='50'></td>";
                                echo "<td>
                                        <!-- Formulario para el botón Editar -->
                                        <form action='editar.php' method='POST' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit' class='btn btn-sm btn-warning'>
                                                <i class='fas fa-edit'></i> Editar
                                            </button>
                                        </form>
                                        
                                        <!-- Formulario para el botón Eliminar -->
                                        <form action='eliminar.php' method='POST' style='display:inline-block;' onsubmit='return confirmarBorrado();'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit' class='btn btn-sm btn-danger'>
                                                <i class='fas fa-trash'></i> Eliminar
                                            </button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No hay productos disponibles</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
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
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
