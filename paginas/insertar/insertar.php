<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Glucosa y Registros Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-top: 20px;
        }

        .card-custom {
            margin-bottom: 20px;
        }

        .btn-custom {
            width: 100%;
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <!-- Control de Glucosa -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-lg card-custom">
                            <div class="card-body">
                                <h2 class="section-title text-center">Control de Glucosa</h2>
                                <form action="inser.php" method="POST">
                                    <div class="mb-3">
                                        <label for="fecha_control">Selecciona una fecha:</label>
                                        <input type="date" id="fecha_control" name="fecha_control" min="1975-01-01" required>
                                        <script>
                                            // Obtener la fecha de hoy en formato YYYY-MM-DD
                                            let hoy = new Date().toISOString().split("T")[0];
                                            document.getElementById("fecha_control").setAttribute("max", hoy);
                                        </script>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="deporte" class="form-label">Tiempo de Deporte (1-5):</label>
                                        <input type="number" id="deporte" name="deporte" class="form-control" min="1" max="5" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="lenta" class="form-label">Insulina Lenta (unidades):</label>
                                        <input type="number" id="lenta" name="lenta" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit_control" class="btn btn-primary btn-custom">Añadir Control</button>
                                </form>
                            </div>
                        </div>

                        <!-- Registro de Comida -->
                        <div class="card shadow-lg card-custom">
                            <div class="card-body">
                                <h2 class="section-title text-center">Registro de Comida</h2>
                                <form action="inser.php" method="POST">
                                    <div class="mb-3">
                                        <label for="tipo_comida" class="form-label">Tipo de Comida:</label>
                                        <select id="tipo_comida" name="tipo_comida" class="form-control" required>
                                            <option>Desayuno</option>
                                            <option>Comida</option>
                                            <option>Cena</option>
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
                                        <label for="gl_1h" class="form-label">Glucosa 1h después (mg/dL):</label>
                                        <input type="number" name="gl_1h" id="gl_1h" class="form-control" min="40" max="600" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gl_2h" class="form-label">Glucosa 2h después (mg/dL):</label>
                                        <input type="number" name="gl_2h" id="gl_2h" class="form-control" min="40" max="600" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="raciones" class="form-label">Raciones:</label>
                                        <input type="number" name="raciones" id="raciones" class="form-control" min="0" max="20" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="insulina" class="form-label">Insulina (unidades):</label>
                                        <input type="number" name="insulina" id="insulina" class="form-control" min="0" max="100" required>
                                    </div>
                                    <button type="submit" name="submit_comida" class="btn btn-primary btn-custom">Añadir Comida</button>
                                </form>
                            </div>
                        </div>

                        <!-- Registro de Hiperglucemia -->
                        <div class="card shadow-lg card-custom">
                            <div class="card-body">
                                <h2 class="section-title text-center">Hiperglucemia</h2>
                                <form action="inser.php" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="tipo_comida_hiper" class="form-label">Tipo de Comida:</label>
                                        <select id="tipo_comida_hiper" name="tipo_comida_hiper" class="form-control" required>
                                            <option>Desayuno</option>
                                            <option>Comida</option>
                                            <option>Cena</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_hiper">Selecciona una fecha:</label>
                                        <input type="date" id="fecha_hiper" name="fecha_hiper" min="1975-01-01" required>
                                        <script>
                                            // Obtener la fecha de hoy en formato YYYY-MM-DD
                                            let hoy_hiper = new Date().toISOString().split("T")[0];
                                            document.getElementById("fecha_hiper").setAttribute("max", hoy);
                                        </script>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="glucosa_hiper" class="form-label">Glucosa (mg/dL):</label>
                                        <input type="number" name="glucosa_hiper" id="glucosa_hiper" class="form-control" min="40" max="600" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="hora_hiper">Hora:</label>
                                        <input type="time" name="hora_hiper" id="hora_hiper" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="correccion" class="form-label">Corrección (unidades):</label>
                                        <input type="number" name="correccion" id="correccion" class="form-control" min="0" max="50" required>
                                    </div>
                                    <button type="submit" name="submit_hiperglucemia" class="btn btn-primary btn-custom">Añadir Hiperglucemia</button>
                                </form>
                            </div>
                        </div>

                        <!-- Registro de Hipoglucemia -->
                        <div class="card shadow-lg card-custom">
                            <div class="card-body">
                                <h2 class="section-title text-center">Hipoglucemia</h2>
                                <form action="inser.php" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="tipo_comida_hipo" class="form-label">Tipo de Comida:</label>
                                        <select id="tipo_comida_hipo" name="tipo_comida_hipo" class="form-control" required>
                                            <option>Desayuno</option>
                                            <option>Comida</option>
                                            <option>Cena</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_hipo">Selecciona una fecha:</label>
                                        <input type="date" id="fecha_hipo" name="fecha_hipo" min="1975-01-01" required>
                                        <script>
                                            // Obtener la fecha de hoy en formato YYYY-MM-DD
                                            let hoy_hipo = new Date().toISOString().split("T")[0];
                                            document.getElementById("fecha_hipo").setAttribute("max", hoy);
                                        </script>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="glucosa_hipo" class="form-label">Glucosa (mg/dL):</label>
                                        <input type="number" name="glucosa_hipo" id="glucosa_hipoglucemia" class="form-control" min="40" max="600" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="hora_hipoglucemia">Hora:</label>
                                        <input type="time" name="hora_hipo" id="hora_hipo" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit_hipo" class="btn btn-primary btn-custom">Añadir Hipoglucemia</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>