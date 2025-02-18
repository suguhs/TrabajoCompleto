<?php
session_start();
include_once '../../conexion.php';

// Activa reporte de errores en mysqli (solo para desarrollo)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Recoger datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contra  = $_POST['contra'] ?? '';

if (empty($usuario) || empty($contra)) {
    echo "Por favor, completa todos los campos.";
    exit();
}

// Quita cualquier salida innecesaria en el archivo de conexión, como "Conexión exitosa".

// Consulta para obtener el hash de la contraseña
$sql = "SELECT id_usu, contra FROM usuario WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id_usu, $hashed_password);
    $stmt->fetch();

    // Para depuración: muestra el hash obtenido (remover en producción)
    echo "<pre>Hash obtenido: " . htmlspecialchars($hashed_password, ENT_QUOTES, 'UTF-8') . "</pre>";
    echo "<pre>Contraseña ingresada: " . htmlspecialchars($contra, ENT_QUOTES, 'UTF-8') . "</pre>";

    // Verificar la contraseña ingresada con la almacenada en la BD
    if (password_verify($contra, $hashed_password)) {
        // Autenticación exitosa
        $_SESSION['id_usu'] = $id_usu;
        $stmt->close();
        header("Location: organizador.php");
        exit();
    } else {
        echo "Contraseña incorrecta. <a href='../../iniciarses.php'>Inténtalo de nuevo</a>";
    }
} else {
    echo "Usuario no encontrado. <a href='../../iniciarses.php'>Inténtalo de nuevo</a>";
}

$stmt->close();
$conn->close();
?>
