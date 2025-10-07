<?php
session_start();
include '../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_tarea'])) {
    $id_tarea = mysqli_real_escape_string($conn, $_POST['id_tarea']);
    $usuario = $_SESSION['usuario'];

    $sql_user = "SELECT id FROM users WHERE email = '$usuario' LIMIT 1";
    $result_user = mysqli_query($conn, $sql_user);
    
    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $user_id = $user['id'];

        $sql = "DELETE FROM tasks WHERE id = '$id_tarea' AND user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_affected_rows($conn) > 0) {
            header("Location: dashboard.php?mensaje=eliminado");
            exit();
        } else {
            exit();
        }
    }
}
exit();
?>
