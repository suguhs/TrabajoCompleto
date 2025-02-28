<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Actualizar Registro</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
  </style>
  <script>
    function toggleGlucoseFields() {
      const option = document.getElementById("glucose_type").value;
      document.getElementById("hiper_fields").style.display = option === "hiper" ? "block" : "none";
      document.getElementById("hipo_fields").style.display = option === "hipo" ? "block" : "none";
    }
  </script>
</head>
<body class="d-flex justify-content-center align-items-center">
  <div class="card shadow" style="max-width: 500px; width: 100%;">
    <div class="card-header bg-warning text-white text-center">
      <h3>Actualizar Registro</h3>
    </div>
    <div class="card-body">
      <form action="../modificador.php" method="post">
        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha:</label>
          <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
          <select id="tipo_comida" name="tipo_comida" class="form-select" required>
            <option value="desayuno">Desayuno</option>
            <option value="almuerzo">Almuerzo</option>
            <option value="cena">Cena</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="glucose_type" class="form-label">Tipo de Glucosa:</label>
          <select id="glucose_type" name="glucose_type" class="form-select" onchange="toggleGlucoseFields()">
            <option value="">Seleccione...</option>
            <option value="hiper">Hiperglucemia</option>
            <option value="hipo">Hipoglucemia</option>
          </select>
        </div>
        <div id="hiper_fields" style="display: none;">
          <div class="mb-3">
            <label for="glucosa_hiper" class="form-label">Glucosa Hiper:</label>
            <input type="number" id="glucosa_hiper" name="glucosa_hiper" class="form-control">
          </div>
          <div class="mb-3">
            <label for="hora_hiper" class="form-label">Hora Hiper:</label>
            <input type="time" id="hora_hiper" name="hora_hiper" class="form-control">
          </div>
          <div class="mb-3">
            <label for="correccion" class="form-label">Corrección:</label>
            <input type="number" id="correccion" name="correccion" class="form-control">
          </div>
        </div>
        <div id="hipo_fields" style="display: none;">
          <div class="mb-3">
            <label for="glucosa_hipo" class="form-label">Glucosa Hipo:</label>
            <input type="number" id="glucosa_hipo" name="glucosa_hipo" class="form-control">
          </div>
          <div class="mb-3">
            <label for="hora_hipo" class="form-label">Hora Hipo:</label>
            <input type="time" id="hora_hipo" name="hora_hipo" class="form-control">
          </div>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-warning">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
