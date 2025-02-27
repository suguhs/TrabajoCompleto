<?php
include_once "../../conexion.php";
session_start();

// Verificar que el usuario está autenticado
$id_usuario = $_SESSION['id_usu'];

// Recoger datos del formulario con valores por defecto
$fecha = $_POST['fecha'] ?? null;
$tipo_comida = $_POST['tipo_comida'] ?? null;
$gl_1h = $_POST['gl_1h'] ?? 0;
$gl_2h = $_POST['gl_2h'] ?? 0;
$raciones = $_POST['raciones'] ?? 0;
$insulina = $_POST['insulina'] ?? 0;
$deporte = $_POST['deporte'] ?? 0;
$lenta = $_POST['lenta'] ?? 0;
$glucosa_hiper = $_POST['glucosa_hiper'] ?? null;
$hora_hiper = $_POST['hora_hiper'] ?? null;
$correccion = $_POST['correccion'] ?? null;
$glucosa_hipo = $_POST['glucosa_hipo'] ?? null;
$hora_hipo = $_POST['hora_hipo'] ?? null;

// Conexión y actualización en la tabla CONTROL_GLUCOSA
if (isset($_POST['submit_control'])) {
    // Se esperan los campos: fecha, deporte y lenta
    $fecha = $_POST['fecha_control'];
    $deporte = $_POST['deporte'];
    $lenta = $_POST['lenta'];

    // Verificar que la fecha y los campos necesarios están presentes
    if (empty($fecha) || !isset($deporte) || !isset($lenta)) {
        die("La fecha, deporte y lenta son obligatorios.");
    }

    $sql = "UPDATE control_glucosa SET deporte = ?, lenta = ? WHERE fecha = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $deporte, $lenta, $fecha, $id_usuario);
    if (!$stmt->execute()) {
        error_log("Error al modificar datos en CONTROL_GLUCOSA: " . $stmt->error);
        die("Hubo un problema al actualizar los datos. Por favor, intente más tarde.");
    }
    $stmt->close();
}

// Conexión y actualización en la tabla COMIDA
if (isset($_POST['submit_comida'])) {
    // Se esperan los campos: fecha, tipo_comida, gl_1h, gl_2h, raciones e insulina
    $fecha_comida = $_POST['fecha_comida'];
    $tipo_comida = $_POST['tipo_comida'];
    $gl_1h = $_POST['gl_1h'];
    $gl_2h = $_POST['gl_2h'];
    $raciones = $_POST['raciones'];
    $insulina = $_POST['insulina'];

    // Verificar que la fecha y tipo de comida son obligatorios
    if (empty($fecha_comida) || empty($tipo_comida)) {
        die("La fecha y el tipo de comida son obligatorios.");
    }

    $sql = "UPDATE comida SET gl_1h = ?, gl_2h = ?, raciones = ?, insulina = ? WHERE fecha = ? AND tipo_comida = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisssi", $gl_1h, $gl_2h, $raciones, $insulina, $fecha_comida, $tipo_comida, $id_usuario);
    if (!$stmt->execute()) {
        error_log("Error al modificar datos en COMIDA: " . $stmt->error);
        die("Hubo un problema al actualizar los datos. Por favor, intente más tarde.");
    }
    $stmt->close();
}

// Actualizar en la tabla HIPERGLUCEMIA si hay datos
if (!empty ($_POST['glucosa_hiper'])) {
    // Se esperan los campos: fecha, glucosa_hiper, hora_hiper y correccion
    $fecha_hiper = $_POST['fecha'];
    $glucosa_hiper = $_POST['glucosa_hiper'] ?? null;
    $hora_hiper = $_POST['hora_hiper'] ?? null;
    $correccion = $_POST['correccion'] ?? null;

    // Verificar que los campos necesarios no están vacíos
    if (empty($glucosa_hiper) || empty($hora_hiper) || empty($correccion)) {
        die("Faltan datos necesarios para la hiperglucemia.");
    }

    $sql = "UPDATE hiperglucemia SET glucosa = ?, hora = ?, correccion = ? WHERE fecha = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisi", $glucosa_hiper, $hora_hiper, $correccion, $fecha_hiper, $id_usuario);
    if (!$stmt->execute()) {
        error_log("Error al modificar datos en HIPERGLUCEMIA: " . $stmt->error);
        die("Hubo un problema al actualizar los datos. Por favor, intente más tarde.");
    }
    $stmt->close();
    echo "Los datos han sido modificados correctamente.";
}

// Actualizar en la tabla HIPOGLUCEMIA si hay datos
if (!empty($_POST['glucosa_hipo'])) {
    // Se esperan los campos: fecha, glucosa_hipo, hora_hipo y tipo_comida_hipo
    $fecha_hipo = $_POST['fecha'];
    $glucosa_hipo = $_POST['glucosa_hipo'] ?? null;
    $hora_hipo = $_POST['hora_hipo'] ?? null;
    $tipo_comida_hipo = $_POST['tipo_comida'];

    // Verificar que los campos necesarios no están vacíos
    if (empty($glucosa_hipo) || empty($hora_hipo)) {
        die("Faltan datos necesarios para la hipoglucemia.");
    }

    $sql = "UPDATE hipoglucemia SET glucosa = ?, hora = ? WHERE fecha = ? AND id_usu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $glucosa_hipo, $hora_hipo, $fecha_hipo, $id_usuario);
    if (!$stmt->execute()) {
        error_log("Error al modificar datos en HIPOGLUCEMIA: " . $stmt->error);
        die("Hubo un problema al actualizar los datos. Por favor, intente más tarde.");
    }
    $stmt->close();
    echo "Los datos han sido modificados correctamente.";
}


?>
