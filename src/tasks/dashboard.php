<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.html");
    exit();
}

$usuario_id = $_SESSION['usuario']; 

$sql_usuario = "SELECT id FROM users WHERE email = '$usuario_id'";
$result_usuario = mysqli_query($conn, $sql_usuario);

if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
    $usuario = mysqli_fetch_assoc($result_usuario);
    $user_id = $usuario['id']; 
} else {
    echo "Usuario no encontrado.";
    exit();
}

$sql_usuario = "SELECT email FROM users WHERE email = '$usuario_id'";
$result_usuario = mysqli_query($conn, $sql_usuario);

if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
    $usuario = mysqli_fetch_assoc($result_usuario);
    $usuario_email = $usuario['email']; 
} else {
    echo "Usuario no encontrado.";
    exit();
}

$sql = "SELECT * FROM tasks WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

$mensaje = '';
if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado') {
    $mensaje = 'Tarea eliminada correctamente.';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>K-BAN || Dashboard</title>
    <!-- Icono -->
    <link rel="shortcut icon" href="https://i.pinimg.com/736x/6c/f0/6e/6cf06e9af749f9342776c02a48b8cd23.jpg"
        type="image/x-icon">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Estilos -->
        <link rel="stylesheet" href="../assets/css/style_dashboard.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Bienvenido al Dashboard</h2>
    <p>Usuario: <strong><?php echo htmlspecialchars($usuario_email); ?></strong></p>
    
    <div class="row mb-4">
        <div class="col-3">
            <a href="create.php" class="btn btn-create w-100">Crear Tarea</a>
        </div>
        <div class="col-3">
         <button type="submit" class="btn btn-edit w-100" id="btn-editar">Editar Tarea</button>
        </div>
        <div class="col-3">
        <form id="form-eliminar" method="POST" action="delete.php">
            <input type="hidden" name="id_tarea" id="id_tarea">
            <button type="submit" class="btn btn-delete w-100" id="btn-eliminar">Eliminar tarea</button>
        </form>
        </div>
        <div class="col-3">
        <div class="btn btn-close w-100">
            <a href="../users/php/logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h4>Selecciona una tarea</h4>
            <form method="POST" id="form-tareas">
            <?php if ($mensaje): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>
                <div class="list-group">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" name="tarea[]" value="<?php echo $row['id']; ?>" class="form-check-input select-tarea">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </div>
                            <div>
                                <?php echo htmlspecialchars($row['stage']); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>                
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script src="../assets/js/action-delete.js"></script>
    <script src="../assets/js/action-update.js"></script>
</body>
</html>
