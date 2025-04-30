const form = document.getElementById('recoverForm');
const alerta = document.getElementById('alerta');

form.addEventListener('submit', function(event) {
  const pass = document.getElementById('new_password').value;
  const confirm = document.getElementById('confirm_password').value;

  if (pass !== confirm) {
    event.preventDefault(); // evita enviar el formulario
    mostrarAlerta('Las contraseñas no coinciden.', 'danger');
  }
});

function mostrarAlerta(mensaje, tipo) {
  alerta.textContent = mensaje;
  alerta.className = `alert alert-${tipo}`;
  alerta.classList.remove('d-none');
}