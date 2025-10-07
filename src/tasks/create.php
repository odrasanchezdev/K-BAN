<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $estado = $_POST['estado'];
    $usuario_email = $_SESSION['usuario'];

    $query_usuario = "SELECT id FROM users WHERE email = '$usuario_email' LIMIT 1";
    $result_usuario = mysqli_query($conn, $query_usuario);
    $usuario = mysqli_fetch_assoc($result_usuario);
    $usuario_id = $usuario['id'];

    if (empty($_POST['estado'])) {
        $error = "Debes seleccionar un estado válido.";
    }

    $sql = "INSERT INTO tasks (user_id, title, stage) VALUES ('$usuario_id', '$titulo', '$estado')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ./dashboard.php?tarea=creada");
        exit();
    } else {
        $error = "Error al crear la tarea.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>K-BAN || Crear tarea</title>
    <!-- Icono -->
    <link rel="shortcut icon" href="https://i.pinimg.com/736x/6c/f0/6e/6cf06e9af749f9342776c02a48b8cd23.jpg"
      type="image/x-icon">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../assets/css/style_dashboard.css">
</head>
<body class="container py-5">

    <h2>Crear una nueva tarea</h2>

    <div class="container d-flex justify-content-center align-items-center vh-80">
    <div class="card p-4 rounded-3" style="width: 100%; max-width: 400px;">

    <form method="POST" action="create.php">
        <div class="mb-3">
            <label for="titulo" class="form-label">Tarea</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
            <option value="" selected disabled hidden>Seleccione el estado de la tarea</option>    
                <option value="todo">To Do</option>
                <option value="en_proceso">En proceso</option>
                <option value="listo">Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-create">Guardar</button>
        <a href="./dashboard.php" class="btn btn-secondary">Cancelar</a>
    </form>
    </div>
  </div>
</body>
</html>
