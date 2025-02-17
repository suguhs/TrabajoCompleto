<?php
include_once 'conexion.php';

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$contrasena = $_POST['contra'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

// Hash de la contraseña
$hashed_contrasena = password_hash($contrasena, PASSWORD_BCRYPT);

// Construir la consulta SQL directamente con los valores
$sql_usuario = "INSERT INTO USUARIO (fecha_nacimiento, nombre, apellidos, usuario, contra) 
                VALUES ('$fecha_nacimiento', '$nombre', '$apellidos', '$usuario', '$hashed_contrasena')";

// Ejecutar la consulta
if ($conn->query($sql_usuario) === TRUE) {
    $id_usu = $conn->insert_id; // Obtener el ID del usuario insertado
    echo "Usuario registrado con éxito. ID: " . $id_usu;
} else {
    echo "Error al registrar el usuario.";
}
?>
