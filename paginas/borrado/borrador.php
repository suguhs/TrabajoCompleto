<?php
include_once "../../conexion.php";
session_start();

// Habilitar el modo de errores de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$fecha = $_POST['fecha'];
$tipo_comida = $_POST['tipo_comida'];
$id_usuario = $_SESSION['id_usu'];

// Verificar los datos antes de la eliminación
echo "Datos a eliminar en COMIDA: tipo_comida=$tipo_comida, fecha=$fecha, id_usuario=$id_usuario";

// Eliminar registros en la tabla COMIDA según la fecha y tipo de comida
$sql_delete_comida = "DELETE FROM COMIDA WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
$stmt_delete_comida = $conn->prepare($sql_delete_comida);
$stmt_delete_comida->bind_param("ssi", $fecha, $tipo_comida, $id_usuario);

if ($stmt_delete_comida->execute()) {
    header('Location: resp_borra.php');
    exit();
} else {
    echo "Error al eliminar datos en COMIDA: " . $stmt_delete_comida->error;
}

// Eliminar registros en la tabla CONTROL_GLUCOSA según la fecha y id_usu
$sql_delete_glucosa = "DELETE FROM CONTROL_GLUCOSA WHERE fecha = ? AND id_usu = ?";
$stmt_delete_glucosa = $conn->prepare($sql_delete_glucosa);
$stmt_delete_glucosa->bind_param("si", $fecha, $id_usuario);

if ($stmt_delete_glucosa->execute()) {
    header('Location: resp_borra.php');
    exit();
} else {
    echo "Error al eliminar datos en CONTROL_GLUCOSA: " . $stmt_delete_glucosa->error;
}

// Eliminar registros en la tabla HIPERGLUCEMIA según la fecha y id_usu
$sql_delete_hiper = "DELETE FROM HIPERGLUCEMIA WHERE fecha = ? AND id_usu = ?";
$stmt_delete_hiper = $conn->prepare($sql_delete_hiper);
$stmt_delete_hiper->bind_param("si", $fecha, $id_usuario);

if ($stmt_delete_hiper->execute()) {
    header('Location: resp_borra.php');
    exit();
} else {
    echo "Error al eliminar datos en HIPERGLUCEMIA: " . $stmt_delete_hiper->error;
}

// Eliminar registros en la tabla HIPOGLUCEMIA según la fecha y id_usu
$sql_delete_hipo = "DELETE FROM HIPOGLUCEMIA WHERE fecha = ? AND id_usu = ?";
$stmt_delete_hipo = $conn->prepare($sql_delete_hipo);
$stmt_delete_hipo->bind_param("si", $fecha, $id_usuario);

if ($stmt_delete_hipo->execute()) {
    header('Location: resp_borra.php');
    exit();
} else {
    echo "Error al eliminar datos en HIPOGLUCEMIA: " . $stmt_delete_hipo->error;
}
?>