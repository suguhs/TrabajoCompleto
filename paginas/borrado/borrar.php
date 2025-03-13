<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eliminar Registro</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card shadow" style="max-width: 400px; width: 100%;">
    <div class="card-header bg-danger text-white text-center">
      <h2 class="mb-0">Eliminar Registro</h2>
    </div>
    <div class="card-body">
      <form action="borrador.php" method="post">
      <div class="mb-3">
          <label for="fecha">Selecciona una fecha:</label>
          <input type="date" id="fecha" name="fecha_control" min="1975-01-01" required>
          <script>
            // Obtener la fecha de hoy en formato YYYY-MM-DD
            let hoy = new Date().toISOString().split("T")[0];
            document.getElementById("fecha").setAttribute("max", hoy);
          </script>
        </div>
        <div class="mb-3">
          <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
          <select id="tipo_comida" name="tipo_comida" class="form-select" required>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
          </select>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    