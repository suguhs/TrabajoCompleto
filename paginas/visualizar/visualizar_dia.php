<?php
include_once "../../conexion.php";
session_start();

// Habilitar el modo de errores de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id_usuario = $_SESSION['id_usu'];
$fecha = $_POST['fecha'] ?? null;
$result = null;

if ($fecha) {
    // Obtener los registros de la base de datos para un día específico
    $sql = "SELECT * FROM COMIDA WHERE id_usu = ? AND fecha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id_usuario, $fecha);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Registros por Día</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Registros por Día</h3>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Selecciona una fecha:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Buscar</button>
                    </form>
                </div>
            </div>

            <!-- Enlaces centrados con separación -->
            <div class="text-center mb-3">
                <a href="selector_visualizar.php" class="btn btn-primary btn-sm mx-2">Volver</a>
                <a href="../../menu.php" class="btn btn-primary btn-sm mx-2">Regresar al menu</a>
            </div>
        </div>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="mt-4">
            <h4 class="text-center">Resultados para la fecha: <strong><?php echo htmlspecialchars($fecha); ?></strong></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de Comida</th>
                            <th>Glucosa 1h</th>
                            <th>Glucosa 2h</th>
                            <th>Raciones</th>
                            <th>Insulina</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo_comida']); ?></td>
                            <td><?php echo htmlspecialchars($row['gl_1h']); ?></td>
                            <td><?php echo htmlspecialchars($row['gl_2h']); ?></td>
                            <td><?php echo htmlspecialchars($row['raciones']); ?></td>
                            <td><?php echo htmlspecialchars($row['insulina']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php elseif ($fecha): ?>
        <div class="alert alert-warning text-center mt-4">No hay registros para la fecha seleccionada.</div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if ($result) {
    $stmt->close();
}
$conn->close();
?>
