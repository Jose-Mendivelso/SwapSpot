<?php

    include("../../../config/conexion_bd.php");
    include("../../controllers/sesion.php"); // Archivo que contiene la conexión a la base de datos
    
    //Valida si el cargo del usuario esta definido o si es igual a 2
    if (!isset($_SESSION['Cargo']) || $_SESSION['Cargo'] == 2) {

        header("Location:  ../../views/inicio_sesion.php");
        exit();

    }
    
    //Confirma que la id del usuario haya sido enviada y que la variable tenga algun valor
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $Id_usuario = $_GET['id']; //Asigna el valor enviado a la variable Id_usuario
        $sql = "SELECT Estado FROM usuarios WHERE Id_usuario='$Id_usuario'";
        $resultado = $conexion->query($sql);
    
        if ($resultado->num_rows > 0) {

            $row = $resultado->fetch_assoc();
            $Estado = $row['Estado']; // Obtener el valor del estado
            // Cambiar el estado del usuario según su valor actual
            if ($Estado == 0) {

                $suspender = "UPDATE usuarios SET Estado = 1 WHERE Id_usuario='$Id_usuario'";
                $ejecutar = mysqli_query($conexion, $suspender);
                header('Location: ../../views/admin/administrador.php');

            } elseif ($Estado == 1) {

                $suspender = "UPDATE usuarios SET Estado = 0 WHERE Id_usuario='$Id_usuario'";
                $ejecutar = mysqli_query($conexion, $suspender);
                header('Location: ../../views/admin/administrador.php');

            }

        } else {

            echo "Usuario no encontrado.";

        }exit();

    } else {

        echo "ID de usuario no proporcionado o vacío.";

    }

?>
