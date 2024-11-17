// Obtener referencias a elementos del DOM
var modal = document.getElementById("Modal"); // Modal para agregar
var btnAbrirModal = document.getElementById("openModalBtn"); // Botón para abrir el modal de agregar
var spanCerrar = document.getElementsByClassName("close")[0]; // Cerrar el modal de agregar
var modalEdit = document.getElementById("modalEdit"); // Modal para editar
var spanCerrarEdit = modalEdit.getElementsByClassName("close")[0]; // Cerrar el modal de editar

// Función para abrir el modal de agregar
function abrirModal() {
  modal.style.display = "block";
}

// Función para cerrar el modal de agregar
function cerrarModal() {
  modal.style.display = "none";
}

function editIngreso(idIngreso, monto, formaPago, fecha, nota) {
  // Asignar los valores de los ingresos al formulario del modal
  document.getElementById("editIdIngreso").value = idIngreso;
  document.getElementById("editMonto").value = monto;
  document.getElementById("editFormaPago").value = formaPago;
  document.getElementById("editFecha").value = fecha; // Asegúrate de que la fecha esté en formato adecuado (YYYY-MM-DD)
  document.getElementById("editNota").value = nota;
  

  // Mostrar el modal
  document.getElementById("modalEdit").style.display = "block";
}

// Cerrar el modal al hacer clic en la "X"
function closeEditModal() {
  document.getElementById("modalEdit").style.display = "none";
}

// Asocia los eventos para abrir y cerrar el modal de agregar
btnAbrirModal.addEventListener("click", abrirModal);
spanCerrar.addEventListener("click", cerrarModal);

// Asocia los eventos para cerrar el modal de editar
spanCerrarEdit.addEventListener("click", closeModal);








