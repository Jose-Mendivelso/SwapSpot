<?php

    include("../../../config/conexion_bd.php");
    include("../../controllers/sesion.php"); // Archivo que contiene la conexión a la base de datos
    
    /*CONSULTAS DE LAS CATEGORIAS */
    $query_categoria = mysqli_query($conexion, "SELECT Id_categoria, Nombre_ca FROM categoria");
        $resultado = mysqli_num_rows($query_categoria);
        mysqli_close($conexion);
        
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../public/assets/css/styles.css">
        <link rel="icon" href="img/favicon_io/favicon-32x32.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
        <title>Publicar Producto - SwapSpot</title>
    </head>
    <body class="body_i">
        <div class="salir">
        <div class="back-row">
        <a href="sesion_iniciada.php">
            <svg viewBox="0 0 1024 1024" fill="#000000" class="icon-back" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M669.6 849.6c8.8 8 22.4 7.2 30.4-1.6s7.2-22.4-1.6-30.4l-309.6-280c-8-7.2-8-17.6 0-24.8l309.6-270.4c8.8-8 9.6-21.6 2.4-30.4-8-8.8-21.6-9.6-30.4-2.4L360.8 480.8c-27.2 24-28 64-0.8 88.8l309.6 280z" fill=""></path>
                </g>
            </svg>
        </a>
        </div>
        </div>
        <div class="container">
            <h2>Publicar Producto</h2>
            <div class="form-image-container">
                <form action="../../models/models_user/producto.php" method="POST" enctype="multipart/form-data" class="form-container" >
                    <label for="product-name">Nombre del Producto</label>
                    <input type="text" id="product-name"  class="input-publicar" name="Nombre_producto" required>
    
                    <label for="product-description">Descripción</label>
                    <input id="product-description" name="Descripcion_producto" class="input-publicar" rows="4" required></input>
    
                    <label for="product-price">Lo cambio por...</label>
                    <textarea id="product-description" name="Cambio_producto" class="input-publicar" rows="1" ></textarea>
    
                    <label for="product-price">Precio</label>
                    <input type="number" id="product-price" name="Precio_producto" class="input-publicar" min="0" step="0.01" >
    
                    <label for="product-images">Subir Imágenes</label>
                    <input type="file" id="foto" name="Imagen_producto" class="input-publicar" accept="image/*" multiple required onchange="previewImages(event)">
    
                    <label for="catagoria">Categoría</label>
                    <select id="product-category" name="Categoria_producto" class="input" required >
                    <?php
                        if($resultado > 0){
                            while($categoria = mysqli_fetch_array($query_categoria)){
                                # code...
                    ?>
                        <option value="<?php echo $categoria['Id_categoria'];?>"><?php echo $categoria['Nombre_ca'];?>
                        </option>
                    <?php
                            }
                        }
                    ?>
                    </select>
                    <button type="submit" class="submit-btn">Publicar Producto</button>
                </form>
                <!-- Contenedor para mostrar las imágenes -->
                <div id="image-preview-container"></div>
            </div>
        </div>
        <script src="../../../public/assets/js/botones_index.js"></script>
    </body>
</html>
