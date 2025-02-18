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
    if($stmt->num_rows > 0 ){
        $stmt->bind_result($id_usu, $hashed_contrasena); // Vincular las variables
        $stmt->fetch(); // Obtener los datos
        
        if (password_verify($contra, $hashed_contrasena)) { // Comparar contraseñas
            $_SESSION['usuario'] = $usuario;
            header("Location: ../../inicio.php");
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='inciarse.php'>Inténtalo de nuevo</a>";
        }
    } else {
        echo "Usuario no encontrado. <a href='iniciarse.php'>Inténtalo de nuevo</a>";
    }

    $stmt->close();
} else {
    echo "Por favor, completa todos los campos.";
}

$conn->close();
?>
