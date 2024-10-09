<?php

    include("../../../config/conexion_bd.php");
    include("../../controllers/sesion.php"); // Archivo que contiene la conexión a la base de datos
    
    /* SE CREAN LAS VARIABLES PARA ALMACENAR LOS DATOS DEL REGISTRO */
    $Nombre_producto = $_POST['Nombre_producto'];
    $Descripcion_producto = $_POST['Descripcion_producto'];
    $Cambio_producto = $_POST['Cambio_producto'];
    $Precio_producto = $_POST['Precio_producto'];
    $Categoria_producto = $_POST['Categoria_producto'];
    
    //Verifica si la variable fue enviada correctamente y sin errores
    if (isset($_FILES['Imagen_producto']) && $_FILES['Imagen_producto']['error'] == 0) {

        $Imagen_producto = $_FILES['Imagen_producto']; //Almacena la informacion del archivo
        $Nombre_imagen = date("Y-m-d-H-i-s") . ".jpg"; //Genera un nombre unico a la imagen
        //Combina el nombre orginal con el nombre unico
        $Archivo = $Nombre_imagen."".$_FILES['Imagen_producto']['name']; 
        //Define la ubicación donde se almacena la imagen en el servidor a la ubicación especificada ($Ubicacion)
        $Ubicacion = "../../../public/assets/images/images_productos/".$Archivo;

        //Mueve el archivo subido desde su ubicación temporal ($_FILES['Imagen_oferta']['tmp_name']) a la ubicación especificada ($Ubicacion)
        if (move_uploaded_file($_FILES['Imagen_producto']['tmp_name'], $Ubicacion)) {

        } else {

            echo 'Error: No se ha subido la imagen';
            exit();

        }

    } else {

        echo 'Error: No se ha subido la imagen';
        exit();

    }
    
    /* Verifica que Id_usuario_sesion esté definida y tenga un valor */
    if (isset($_SESSION['Id_usuario_sesion']) && !empty($_SESSION['Id_usuario_sesion'])) {
        $Id_usuario_sesion = $_SESSION['Id_usuario_sesion'];

    } else {

        // Manejo del caso en que no se haya establecido la sesión o está vacía
        echo '
        <script>
        alert("Error: Sesión no iniciada .");
        window.location = "../../views/inicio_sesion.php";
        </script>
        ';
        exit();

    }
    
    /* SE ALMACENAN LOS VALORES EN LA COLUMNA DE LA TABLA ARTICULO */
    $query = "INSERT INTO articulo (Nombre, Descripcion_producto, categoria, Usuario, Precio, Cambio, Imagen) 
    VALUES('$Nombre_producto', '$Descripcion_producto', '$Categoria_producto', '$Id_usuario_sesion', '$Precio_producto', '$Cambio_producto', '$Archivo')";
    
    /* SE EJECUTA PARA QUE PUEDA ALMACENAR */
    $ejecutar = mysqli_query($conexion, $query);
    
    /* SE MUESTRA UN MENSAJE EN PANTALLA PARA INDICAR SI EL PRODUCTO HA SIDO REGISTRADO O NO EXITOSAMENTE */
    if($ejecutar){

        echo '
        <script>
        alert("Se ha registrado exitosamente");
        window.location = "../../views/user/sesion_iniciada.php";
        </script>
        ';

    } else {

        echo '  
        <script>
        alert("ERROR: Intente nuevamente");
        window.location = "../../views/user/publicar_producto.php";
        </script>      
        ';

    }
    
    /* CERRAMOS LA CONEXIÓN */
    mysqli_close($conexion);

?>