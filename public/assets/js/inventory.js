window.onload = function () {
  let authArea = document.getElementById("authArea");
  let userIcon = document.getElementById("userIcon");
  let dropdownMenu = document.getElementById("dropdownMenu");

  userIcon.onclick = function () {
    dropdownMenu.style.display =
      dropdownMenu.style.display === "block" ? "none" : "block";
  };

  document.addEventListener("click", function (e) {
    if (!authArea.contains(e.target)) {
      dropdownMenu.style.display = "none";
    }
  });

  const editarBtns = document.querySelectorAll(".btn-editar");
  const borrarBtns = document.querySelectorAll(".btn-borrar");
  const nuevoBtns = document.getElementById("btn-nuevo");
  const formEditar = document.getElementById("formulario-editar");
  const formNuevo = document.getElementById("formulario-nuevo");

  let filaActual = null;

  editarBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      if (formEditar.style.display == "block") {
        formEditar.style.display = "none";
      } else {
        formEditar.style.display = "block";
        formNuevo.style.display = "none";
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
      formNuevo.style.display = "none";
    });
  });

  nuevoBtns.onclick = function () {
    if (formNuevo.style.display == "block") {
      formNuevo.style.display = "none";
    } else {
      formNuevo.style.display = "block";
      formEditar.style.display = "none";
      filaActual = this.closest("tr");
    }
  };

  const buscador = document.getElementById("buscador");
  const tabla = document
    .getElementById("tabla")
    .getElementsByTagName("tbody")[0];

  buscador.addEventListener("input", function () {
    const filtro = buscador.value.toLowerCase();
    const filas = tabla.getElementsByTagName("tr");

    for (let i = 0; i < filas.length; i++) {
      const celdas = filas[i].getElementsByTagName("td");
      let coincide = false;

      for (let j = 0; j < celdas.length - 1; j++) {
        if (celdas[j].textContent.toLowerCase().includes(filtro)) {
          coincide = true;
          break;
        }
      }

      filas[i].style.display = coincide ? "" : "none";
    }
  });

  const btnFiltrar = document.getElementById("btn-filtrar");

  btnFiltrar.addEventListener("click", function () {
    buscador.value = "";

    const filas = tabla.getElementsByTagName("tr");
    for (let i = 0; i < filas.length; i++) {
      filas[i].style.display = "";
    }
  });
};
