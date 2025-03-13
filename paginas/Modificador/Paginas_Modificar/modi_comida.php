<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Comida</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 100%; max-width: 500px;">
      <div class="card-header bg-warning text-white text-center">
        <h2 class="mb-0">Registro de Comida</h2>
      </div>
      <div class="card-body">
        <form action="../modificador.php" method="POST">
          <div class="mb-3">
            <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
            <select id="tipo_comida" name="tipo_comida" class="form-select" required>
              <option value="Desayuno">Desayuno</option>
              <option value="Comida">Comida</option>
              <option value="Cena">Cena</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="fecha_comida">Selecciona una fecha:</label>
            <input type="date" id="fecha_comida" name="fecha_comida" min="1975-01-01" required>
            <script>
              // Obtener la fecha de hoy en formato YYYY-MM-DD
              let hoy_comida = new Date().toISOString().split("T")[0];
              document.getElementById("fecha_comida").setAttribute("max", hoy);
            </script>
          </div>
          <div class="mb-3">
            <label for="gl_1h" class="form-label">Glucosa 1h después:</label>
            <input type="number" name="gl_1h" id="gl_1h" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
            <label for="gl_2h" class="form-label">Glucosa 2h después:</label>
            <input type="number" name="gl_2h" id="gl_2h" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
            <label for="raciones" class="form-label">Raciones:</label>
            <input type="number" name="raciones" id="raciones" class="form-control" min="0" required>
          </div>
          <div class="mb-3">
            <label for="insulina" class="form-label">Insulina:</label>
            <input type="number" name="insulina" id="insulina" class="form-control" min="0" required>
          </div>
          <button type="submit" name="submit_comida" class="btn btn-warning w-100">Añadir Comida</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>