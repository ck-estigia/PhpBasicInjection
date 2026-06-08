<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = new PDO(
    "mysql:host=mysql;port=3306;dbname=sqlInjection;charset=utf8mb4",
    "root",
    "rootpassword"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = "";
$sqlDebug = "";
$rows = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // ❗ intentionally insecure
    $sql = "
        SELECT UsuarioId, Nombre, Contrasena
        FROM Usuarios
        WHERE CorreoElectronico = '$correo'
          AND Contrasena = '$contrasena'
    ";

    $sqlDebug = $sql;

    $resultado = $pdo->query($sql);
    $rows = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        $message = "<div class='success'>Login exitoso</div>";
    } else {
        $message = "<div class='error'>Credenciales inválidas</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demo Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-height: 90vh;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #1e3c72;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #2a5298;
            color: white;
        }

        pre {
            background: #f4f4f4;
            padding: 10px;
            font-size: 12px;
            overflow-x: auto;
            border-radius: 6px;
        }

        h4 {
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>Login</h1>

    <?php echo $message; ?>

    <form method="post">

        <label>Correo:</label>
        <input type="text" name="correo" required>

        <label>Contraseña:</label>
        <input type="" name="contrasena" required>

        <button type="submit">Ingresar</button>
    </form>

    <?php if (!empty($sqlDebug)): ?>
        <h4>Debug SQL</h4>
        <pre><?php echo $sqlDebug; ?></pre>
    <?php endif; ?>

    <?php if (!empty($rows)): ?>
        <h4>Results</h4>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contraseña</th>
            </tr>

            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['UsuarioId']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['Contrasena']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

</body>
</html>