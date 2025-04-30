document.getElementById('btn-editar').addEventListener('click', function () {
  const checkboxes = document.querySelectorAll('.select-tarea:checked');

  if (checkboxes.length !== 1) {
      alert('Por favor, selecciona solo una tarea para editar.');
      return;
  }

  const tareaId = checkboxes[0].value;
  window.location.href = `update.php?id=${tareaId}`;
});
