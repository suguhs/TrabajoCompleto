<?php
session_start();
require_once('conexion.php');

// Opcional: activar reporte de errores de MySQLi para depuración (no usar en producción)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo "<h2>Test de Registro y Verificación</h2>";

// 1. Generar contraseña y hash
$plainPassword = "TestPassword123";  // Contraseña de prueba
$hashed = password_hash($plainPassword, PASSWORD_BCRYPT);

// Mostrar el hash para confirmar longitud (normalmente ~60 caracteres con Bcrypt)
echo "<p><strong>Hash generado:</strong> $hashed<br>";
echo "<strong>Longitud del hash:</strong> " . strlen($hashed) . "</p>";

// 2. Insertar un nuevo usuario en la base de datos
$sqlInsert = "INSERT INTO usuario (usuario, contra, nombre, apellidos, fecha_nacimiento) 
              VALUES (?, ?, ?, ?, ?)";

// Datos ficticios para la prueba
$usuario          = "TestUser_" . rand(1000,9999);
$nombre           = "NombrePrueba";
$apellidos        = "ApellidosPrueba";
$fecha_nacimiento = "2000-01-01";

$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("sssss", $usuario, $hashed, $nombre, $apellidos, $fecha_nacimiento);
$stmtInsert->execute();

$lastId = $conn->insert_id; // ID del usuario recién insertado
echo "<p><strong>Usuario insertado con ID:</strong> $lastId</p>";

$stmtInsert->close();

// 3. Recuperar el hash del usuario que acabamos de insertar
$sqlSelect = "SELECT contra FROM usuario WHERE id_usu = ?";
$stmtSelect = $conn->prepare($sqlSelect);
$stmtSelect->bind_param("i", $lastId);
$stmtSelect->execute();
$stmtSelect->bind_result($retrievedHash);
$stmtSelect->fetch();
$stmtSelect->close();

echo "<p><strong>Hash recuperado de la BD:</strong> $retrievedHash<br>";
echo "<strong>Longitud del hash recuperado:</strong> " . strlen($retrievedHash) . "</p>";

// 4. Verificar la contraseña en texto plano contra el hash recuperado
if (password_verify($plainPassword, $retrievedHash)) {
    echo "<p style='color: green;'><strong>Verificación exitosa:</strong> La contraseña coincide.</p>";
} else {
    echo "<p style='color: red;'><strong>Error:</strong> La contraseña no coincide.</p>";
}

// Cerrar la conexión
$conn->close();
?>
