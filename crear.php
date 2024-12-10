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
        <h4>Agregar producto</h4>
        <div class="row">
        <form action="guardar.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
        
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingresa el precio" required>
           
                <label for="url_img">Imagen</label>
                <input type="file" class="form-control-file" id="url_img" name="url_img" required>
            </div>
            </div>
            <div class="col-md-12 text-right">
                <a href="index.php" class="btn btn-secondary" >
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>            
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar producto
                </button>               
            </div>

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
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script-tienda.js"></script>
</body>
</html>
