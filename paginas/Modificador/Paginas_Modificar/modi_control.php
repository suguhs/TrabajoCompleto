<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de Glucosa</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
    }
  </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center">
  <div class="card shadow" style="max-width: 500px; width: 100%;">
    <div class="card-header bg-warning text-white text-center">
      <h2 class="mb-0">Control de Glucosa</h2>
    </div>
    <div class="card-body">
      <form action="../modificador.php" method="POST">
        <div class="mb-3">
          <label for="fecha_control" class="form-label">Fecha:</label>
          <input type="date" id="fecha_control" name="fecha_control" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="deporte" class="form-label">Tiempo de Deporte:</label>
          <input type="number" id="deporte" name="deporte" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="lenta" class="form-label">Insulina Lenta:</label>
          <input type="number" id="lenta" name="lenta" class="form-control" required>
        </div>
        <button type="submit" name="submit_control" class="btn btn-warning w-100">Añadir Control</button>
      </form>
    </div>
  </div>
  
  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
