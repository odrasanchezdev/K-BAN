document.addEventListener('DOMContentLoaded', function () {
  const alerta = document.getElementById('alerta-user');
  const params = new URLSearchParams(window.location.search);
  const error = params.get('error');

  if (error === 'usuario') {
      mostrarAlerta('El usuario no existe', 'danger');
  }

  function mostrarAlerta(mensaje, tipo) {
      alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
      alerta.innerHTML = `
          ${mensaje}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      `;
      alerta.classList.remove('d-none');
  }
});