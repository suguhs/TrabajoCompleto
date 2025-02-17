<?php
include_once 'conexion.php';

$usuario=$_POST['usuario'];
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$contrasena=$_POST['contra'];
$fecha= $_POST['fecha_nacimiento'];

// Insertar datos en la tabla USUARIO
$sql_usuario = "INSERT INTO USUARIO (fecha_nacimiento, nombre, apellidos, usuario, contra)
                VALUES ('$fecha_nacimiento', '$nombre', '$apellidos', '$usuario', '$contra')";

if ($conn->query($sql_usuario) === TRUE) {
    $id_usu = $conn->insert_id; // Obtener el ID del usuario insertado
}


?>