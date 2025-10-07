<?php
include '../../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Este correo ya está registrado.";
    } else {
        // Insertar el usuario
        $insertQuery = "INSERT INTO users (email, contrasena) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Usuario registrado correctamente. <a href='../../index.html'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar: " . mysqli_error($conn);
        }
    }
}
?>
