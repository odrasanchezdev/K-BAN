<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.html");
    exit();
}

$usuario_id = $_SESSION['usuario'];

if (!isset($_GET['id'])) {
    echo "ID de tarea no proporcionado.";
    exit();
}

$tarea_id = $_GET['id'];

// Buscar la tarea
$sql = "SELECT * FROM tasks WHERE id = $tarea_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Tarea no encontrada.";
    exit();
}

$tarea = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['title'];
    $estado = $_POST['stage'];

    $sql_update = "UPDATE tasks SET title = '$titulo', stage = '$estado' WHERE id = $tarea_id";
    if (mysqli_query($conn, $sql_update)) {
        header("Location: dashboard.php?mensaje=actualizado");
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>K-BAN || Editar tarea</title>
    <!-- Icono -->
    <link rel="shortcut icon" href="https://i.pinimg.com/736x/6c/f0/6e/6cf06e9af749f9342776c02a48b8cd23.jpg"
        type="image/x-icon">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Estilos -->
        <link rel="stylesheet" href="../assets/css/style_dashboard.css">
</head>
<body class="container mt-5">
    <h2>Editar Tarea</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($tarea['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="stage" class="form-label">Estado</label>
            <select name="stage" class="form-select" required>
                <option value="todo" <?php if ($tarea['stage'] == 'todo') echo 'selected'; ?>>To Do</option>
                <option value="en_proceso" <?php if ($tarea['stage'] == 'en_proceso') echo 'selected'; ?>>En Proceso</option>
                <option value="listo" <?php if ($tarea['stage'] == 'listo') echo 'selected'; ?>>Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-create">Guardar Cambios</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
