<?php
session_start();
include_once '../../conexion.php';

// Recoger datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contra = $_POST['contra'] ?? '';

if (!empty($usuario) && !empty($contra)) {
    // Consultar el hash de la contraseña almacenada
    $sql = "SELECT id_usu, contra FROM usuario WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();
    
    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usu, $hashed_password);//bind_result permite que los datos obtenidos de la consulta se guarden en variables de PHP
        $stmt->fetch();

        // Verificar la contraseña ingresada con la almacenada en la BD
        if (password_verify($contra, $hashed_password)) {
            // Autenticación exitosa
            $_SESSION['id_usu'] = $id_usu;
            header("Location: ../../menu.php");
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='iniciarse.php'>Inténtalo de nuevo</a>";
        }
    } else {
        echo "Usuario no encontrado. <a href='iniciarse.php'>Inténtalo de nuevo</a>";
    }

    $stmt->close();
} else {
    echo "Por favor, completa todos los campos.";
}
// Cerrar conexión
$conn->close();
?>