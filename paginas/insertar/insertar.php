<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </link>
</head>

<body>
    <form action="inser.php" method="POST">
        <!-- Control de Glucosa -->
        <h2>Control de Glucosa</h2>
        <div class="form-group">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="deporte" class="form-label">Tiempo de Deporte:</label>
            <input type="number" id="deporte" name="deporte" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
            <label for="lenta" class="form-label">Insulina Lenta:</label>
            <input type="number" id="lenta" name="lenta" class="form-control form-control-sm" required>
        </div>


        <!-- Comida -->
        <h2>Registro de Comida</h2>
        <div class="form-group">
            <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
            <select type="text" id="tipo_comida" name="tipo_comida" class="form-control form-control-sm" required>
                <option>Desayuno</option>
                <option>Comida</option>
                <option>Cena</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gl_1h" class="form-label">Glucosa 1h después:</label>
            <input type="number" id="gl_1h" name="gl_1h" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
            <label for="gl_2h" class="form-label">Glucosa 2h después:</label>
            <input type="number" id="gl_2h" name="gl_2h" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
            <label for="raciones" class="form-label">Raciones:</label>
            <input type="number" id="raciones" name="raciones" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
            <label for="insulina" class="form-label">Insulina:</label>
            <input type="number" id="insulina" name="insulina" class="form-control form-control-sm" required>
        </div>



        <!-- Hiperglucemia -->
        <details>
            <summary class="h6">Hiperglucemia (Opcional)</summary>
            <div class="form-group">
                <label for="glucosa_hiper" class="form-label">Glucosa:</label>
                <input type="number" id="glucosa_hiper" name="glucosa_hiper" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="hora_hiper" class="form-label">Hora:</label>
                <input type="time" id="hora_hiper" name="hora_hiper" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="correccion" class="form-label">Corrección:</label>
                <input type="number" id="correccion" name="correccion" class="form-control form-control-sm">
            </div>
        </details>

        <!-- Hipoglucemia -->
        <details>
            <summary class="h6">Hipoglucemia (Opcional)</summary>
            <div class="form-group">
                <label for="glucosa_hipo" class="form-label">Glucosa:</label>
                <input type="number" id="glucosa_hipo" name="glucosa_hipo" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="hora_hipo" class="form-label">Hora:</label>
                <input type="time" id="hora_hipo" name="hora_hipo" class="form-control form-control-sm">
            </div>
        </details>


        <button type="submit" class="btn btn-primary btn-sm w-100">Enviar Datos</button>
    </form>
    </div>
</body>

</html>