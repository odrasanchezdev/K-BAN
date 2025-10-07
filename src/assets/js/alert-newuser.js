const form = document.getElementById('registrar');
const alerta = document.getElementById('alerta');

form.addEventListener('submit', function(event) {
  const pass = document.getElementById('password').value;
  const confirm = document.getElementById('confirm_password').value;

  if (pass !== confirm) {
    event.preventDefault();
    mostrarAlerta('Las contraseñas no coinciden.', 'danger');
  }
});

function mostrarAlerta(mensaje, tipo) {
  alerta.textContent = mensaje;
  alerta.className = `alert alert-${tipo}`;
  alerta.classList.remove('d-none');
}