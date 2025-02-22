<?php
include_once "../../conexion.php";
session_start();

$query = "SELECT id_usu FROM usuario WHERE id_usu = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id_usu']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id_usuario);
$stmt->fetch();

$fecha = $_POST['fecha'];
$tipo_comida = $_POST['tipo_comida'];
$gl_1h = $_POST['gl_1h'];
$gl_2h = $_POST['gl_2h'];
$raciones = $_POST['raciones'];
$insulina = $_POST['insulina'];
$deporte = $_POST['deporte'];
$lenta = $_POST['lenta'];
$glucosa_hiper = $_POST['glucosa_hiper'] ?? null;
$hora_hiper = $_POST['hora_hiper'] ?? null;
$correccion = $_POST['correccion'] ?? null;
$glucosa_hipo = $_POST['glucosa_hipo'] ?? null;
$hora_hipo = $_POST['hora_hipo'] ?? null;

// Verificar los datos antes de la inserción
echo "Datos a insertar en COMIDA: tipo_comida=$tipo_comida, gl_1h=$gl_1h, gl_2h=$gl_2h, raciones=$raciones, insulina=$insulina, fecha=$fecha, id_usuario=$id_usuario";

// INSERCION DE CONTROL DE GLUCOSA
$sql_glucosa = "INSERT INTO CONTROL_GLUCOSA (fecha, deporte, lenta, id_usu) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql_glucosa);
$stmt->bind_param("siii", $fecha, $deporte, $lenta, $id_usuario);
$stmt->execute();

// INSERCION DE LA COMIDA
$sql_comida = "INSERT INTO COMIDA (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_comida);
$stmt->bind_param("siiiisi", $tipo_comida, $gl_1h, $gl_2h, $raciones, $insulina, $fecha, $id_usuario);
if ($stmt->execute()) {
    echo "Datos insertados correctamente en COMIDA.";
} else {
    echo "Error al insertar datos en COMIDA: " . $stmt->error;
}

// INSERCION DE HIPERGLUCEMIA
if (!empty($glucosa_hiper) && !empty($hora_hiper) && !empty($correccion)) {
    $sql_hiper = "INSERT INTO HIPERGLUCEMIA (glucosa_hiper, hora_hiper, correccion, fecha, id_usu) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_hiper);
    $stmt->bind_param("isiss", $glucosa_hiper, $hora_hiper, $correccion, $fecha, $id_usuario);
    $stmt->execute();
}

// INSERCION DE HIPOGLUCEMIA
if (!empty($glucosa_hipo) && !empty($hora_hipo)) {
    $sql_hipo = "INSERT INTO HIPOGLUCEMIA (glucosa_hipo, hora_hipo, fecha, id_usu) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_hipo);
    $stmt->bind_param("issi", $glucosa_hipo, $hora_hipo, $fecha, $id_usuario);
    $stmt->execute();
}
?>