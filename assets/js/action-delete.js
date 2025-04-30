document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.select-tarea');
  const btnEliminar = document.getElementById('btn-eliminar');
  const formEliminar = document.getElementById('form-eliminar');
  const inputHidden = document.getElementById('id_tarea');

  checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', () => {
          const seleccionadas = Array.from(checkboxes).filter(cb => cb.checked);

          if (seleccionadas.length === 1) {
              btnEliminar.disabled = false;
              inputHidden.value = seleccionadas[0].value;

              //console.log("ID de la tarea seleccionada:", inputHidden.value);
          } else {
              btnEliminar.disabled = true;
              inputHidden.value = '';
          }
      });
  });

  // Confirmar antes de eliminar
  formEliminar.addEventListener('submit', function (event) {
      const confirmar = confirm("¿Estás seguro de que deseas eliminar esta tarea?");
      if (!confirmar) {
          event.preventDefault();
      }
  });
});