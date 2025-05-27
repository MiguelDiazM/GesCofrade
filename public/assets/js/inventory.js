window.onload = function () {
  const editarBtns = document.querySelectorAll(".btn-editar");
  const borrarBtns = document.querySelectorAll(".btn-borrar");
  const formEditar = document.getElementById("formulario-editar");
  const form = document.getElementById("form-editar");

  let filaActual = null;

  editarBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (formEditar.style.display == "block") {
            formEditar.style.display = "none";
        } else {
            formEditar.style.display = "block";
            filaActual = this.closest("tr");
            const celdas = filaActual.querySelectorAll("td");

            document.getElementById("referencia").value = celdas[0].innerText;
            document.getElementById("elemento").value = celdas[1].innerText;
            document.getElementById("descripcion").value = celdas[2].innerText;
        }
    });
  });

  borrarBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const fila = this.closest("tr");
      if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
        fila.remove();
      }
      formEditar.style.display = "none";
    });
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    if (filaActual) {
      const celdas = filaActual.querySelectorAll("td");
      celdas[0].innerText = document.getElementById("referencia").value;
      celdas[1].innerText = document.getElementById("elemento").value;
      celdas[2].innerText = document.getElementById("descripcion").value;
      formEditar.style.display = "none";
    }
  });
};
