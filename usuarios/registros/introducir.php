<?php
include_once '../../conexion.php';
session_start(); // Asegurar que la sesión está iniciada

// Verificar que los datos fueron enviados
if (!isset($_POST['usuario'], $_POST['nombre'], $_POST['apellidos'], $_POST['contra'], $_POST['fecha_nacimiento'])) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header('Location: registro.php');
    exit();
}

// Obtener datos del formulario y sanitizar
$usuario = trim($_POST['usuario']);
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$contrasena = $_POST['contra'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

if (empty($usuario) || empty($nombre) || empty($apellidos) || empty($contrasena) || empty($fecha_nacimiento)) {
    $_SESSION['error'] = "No se permiten campos vacíos.";
    header('Location: registro.php');
    exit();
}

// Verificar si el usuario ya existe
$sql_verificar = "SELECT id_usu FROM usuario WHERE usuario = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("s", $usuario);
$stmt_verificar->execute();
$stmt_verificar->store_result();

if ($stmt_verificar->num_rows > 0) {
    $_SESSION['error'] = "El nombre de usuario ya está registrado. Prueba con otro.";
    $stmt_verificar->close();
    header('Location: registro.php'); // Redirigir al formulario con mensaje
    exit();
}

$stmt_verificar->close();

// Hash de la contraseña
$hashed_contrasena = password_hash($contrasena, PASSWORD_BCRYPT);

// Insertar nuevo usuario
$sql_usuario = "INSERT INTO usuario (fecha_nacimiento, nombre, apellidos, usuario, contra) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_usuario);
$stmt->bind_param("sssss", $fecha_nacimiento, $nombre, $apellidos, $usuario, $hashed_contrasena);

if ($stmt->execute()) {
    // Guardar datos en la sesión y redirigir al menú
    $_SESSION['id_usu'] = $stmt->insert_id;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nombre'] = $nombre;

    header('Location: ../../menu.php');
    exit();
} else {
    $_SESSION['error'] = "Error al registrar el usuario.";
    header('Location: registro.php');
    exit();
}

$stmt->close();
$conn->close();
?>
