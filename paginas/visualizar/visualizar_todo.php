<?php
include_once "../../conexion.php";
session_start();

$id_usuario = $_SESSION['id_usu'];

// Obtener todos los registros de la base de datos
$sql = "SELECT * FROM COMIDA WHERE id_usu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Todos los Registros</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4">Todos los Registros</h3>

                    <?php if ($result->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
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
                    <?php else: ?>
                        <div class="alert alert-warning text-center">No hay registros disponibles.</div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
        <a href="selector_visualizar.php" class="btn btn-primary btn-sm w-auto px-3">Volver</a>
    <a href="../../menu.php" class="btn btn-primary btn-sm w-auto px-3">Regresar al menu</a>
</div>


   </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
