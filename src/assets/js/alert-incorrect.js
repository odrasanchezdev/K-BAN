document.addEventListener('DOMContentLoaded', function () {
    const alerta = document.getElementById('alerta-error');
    const params = new URLSearchParams(window.location.search);

    if (params.get('error') === 'contrasena') {
        mostrarAlerta('Contraseña incorrecta', 'danger');
    }
});

function mostrarAlerta(mensaje, tipo) {
    const alerta = document.getElementById('alerta-error');
    alerta.textContent = mensaje;
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.innerHTML += `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>`;
}
