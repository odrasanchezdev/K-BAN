<?php
session_start();
include '../../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email); // 's' es para string

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        if ($resultado && mysqli_num_rows($resultado) == 1) {
            $usuario = mysqli_fetch_assoc($resultado);

            if ($password == $usuario['contrasena']) {
                $_SESSION['usuario'] = $usuario['email'];
                header("Location: ../../tasks/dashboard.php");
                exit;
            } else {
                header("Location: ../../index.html?error=contrasena");
                exit;
            }
        } else {
            header("Location: ../../index.html?error=usuario");
            exit;
        }
    } else {
        echo "Error en la consulta SQL.";
    }
}
?>
