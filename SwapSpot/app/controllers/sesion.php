<?php

    session_start(); //Activa la sesion

    include $_SERVER['DOCUMENT_ROOT'] . '/SwapSpot/config/conexion_bd.php'; //Obtiene la ruta raiz del acricho conexion_bd.php

    if (isset($_SESSION['Email'])) {  //Verifica si la variable de sesión Email está definida

        $email = $_SESSION['Email'];
        $query = "SELECT Id_usuario, Cargo FROM Usuarios WHERE Email = '$email'";
        //Ejecuta la consulta en la base de datos. Si la consulta es exitosa, almacena el resultado en la variable $resultado
        if ($resultado = $conexion->query($query)) { 

            if ($row = $resultado->fetch_assoc()) {
                
                // Almacena el Id_usuario y el Cargo en la sesión para su uso posterior
                $_SESSION['Id_usuario_sesion'] = $row["Id_usuario"];
                // Almacena el Cargo en la sesión
                $_SESSION['Cargo'] = $row["Cargo"]; 
                
            } else {

                // Si no se encuentra el usuario, redirigir al usuario a la página de inicio de sesión
                header("Location: ../views/inicio_sesion");
                exit();
            }

            //Libera la memoria asociada con los resultados de la consulta, optimizando el uso de recursos.
            $resultado->free(); 

        } else {

            echo "Error en la consulta SQL: " . $conexion->error; // Manejo de errores de consulta SQL

        }
    } else {

        // Si la sesión no está establecida, redirigir al usuario a la página de inicio de sesión 
        header("Location:  ../views/inicio_sesion");
        exit();

    }

?>