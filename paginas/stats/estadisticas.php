<?php
session_start();
include_once '../../conexion.php';

if (!isset($_SESSION['id_usu'])) {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usu'];

// Consultas para obtener el número de registros por tabla
$stmt = $conn->prepare("SELECT COUNT(*) FROM CONTROL_GLUCOSA WHERE id_usu = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($count_control);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM COMIDA WHERE id_usu = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($count_comida);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM HIPERGLUCEMIA WHERE id_usu = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($count_hiper);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM HIPOGLUCEMIA WHERE id_usu = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($count_hipo);
$stmt->fetch();
$stmt->close();

// Promedio de glucosa en HIPERGLUCEMIA
$stmt = $conn->prepare("SELECT AVG(glucosa) FROM HIPERGLUCEMIA WHERE id_usu = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($avg_hiper);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estadísticas - Gestión de Diabetes</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Centrar el título */
    h1 {
      text-align: center;
      margin-top: 20px;
    }
    /* Contenedor general para los gráficos centrados */
    .charts-wrapper {
      display: flex;
      justify-content: center;
      gap: 20px; /* Espacio entre gráficos */
      flex-wrap: wrap; /* Se ajusta en pantallas pequeñas */
      margin: 20px 0;
    }
    /* Estilo para cada contenedor de gráfico */
    .chart-container {
      width: 300px;  /* Ajusta según lo necesites */
      height: 300px; /* Ajusta según lo necesites */
    }
  </style>
</head>
<body>

  <h1>Estadísticas de Registros</h1>

  <div class="charts-wrapper">
    <!-- Gráfico de pastel: Número de registros -->
    <div class="chart-container">
      <canvas id="pieChart"></canvas>
    </div>

    <!-- Gráfico de barras: Promedio de glucosa en HIPERGLUCEMIA -->
    <div class="chart-container">
      <canvas id="barChart"></canvas>
    </div>
  </div>

  <!-- Enlace para volver a la página anterior, ubicado debajo de los gráficos -->
  <div class="text-center mb-4">
    <a href="javascript:history.back()" class="btn btn-primary">Volver a la página anterior</a>
  </div>

  <script>
    // Gráfico de pastel
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['CONTROL_GLUCOSA', 'COMIDA', 'HIPERGLUCEMIA', 'HIPOGLUCEMIA'],
        datasets: [{
          data: [<?php echo $count_control; ?>, <?php echo $count_comida; ?>, <?php echo $count_hiper; ?>, <?php echo $count_hipo; ?>],
          backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
        }]
      }
    });

    // Gráfico de barras
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['Promedio de glucosa'],
        datasets: [{
          label: 'Glucosa promedio (mg/dL)',
          data: [<?php echo $avg_hiper; ?>],
          backgroundColor: ['#17a2b8']
        }]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            suggestedMax: 200
          }
        }
      }
    });
  </script>

  <!-- Bootstrap 5 JS (opcional, solo si requieres funcionalidades de Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
