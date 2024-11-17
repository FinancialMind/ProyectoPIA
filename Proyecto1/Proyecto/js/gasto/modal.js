// Modal de agregar gasto
var modal = document.getElementById("Modal");
var btnAbrirModal = document.getElementById("openModalBtn");
var spanCerrar = document.querySelector("#Modal .close"); // Mejor usando querySelector

// Función para abrir el modal
function abrirModal() {
  modal.style.display = "block";
}

// Función para cerrar el modal
function cerrarModal() {
  modal.style.display = "none";
}

// Asociar eventos a las funciones
btnAbrirModal.addEventListener("click", abrirModal);
spanCerrar.addEventListener("click", cerrarModal);

// Modal de edición
var modalEdit = document.getElementById("ModalEdit");
