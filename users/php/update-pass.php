<?php
include '../../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $new_pass = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if ($new_pass !== $confirm) {
      echo "Las contraseñas no coinciden.";
      exit;
  }

    // Verifica si existe el correo
    $sql_check = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result) === 1) {
        $sql_update = "UPDATE users SET contrasena = '$new_pass' WHERE email = '$email'";
        if (mysqli_query($conn, $sql_update)) {
            echo "Contraseña actualizada correctamente. <a href='../../index.html'>Inicia sesión</a>";
        } else {
            echo "Error al actualizar: " . mysqli_error($conn);
        }
    } else {
        echo "El correo no se encuentra registrado.";
    }
}

?>