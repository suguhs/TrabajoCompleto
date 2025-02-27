<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Actualizar Registro</h2>
        <div class="button-container">
            <form action="Paginas_Modificar/modi_control.php" method="post">
                <button type="submit" name="submit_control">Control Glucosa</button>
            </form>
            <form action="Paginas_Modificar/modi_comida.php" method="post">
                <button type="submit" name="submit_comida">Comida</button>
            </form>
            <form action="Paginas_Modificar/hiper_hipo.php" method="post">
                <button type="submit" name="submit_hiper_hipo">Hiper o Hipo</button>
            </form>
        </div>
    </div>

</body>
</html>
