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

  const sidebar = document.getElementById("sidebar");
  const btnToggleSidebar = document.getElementById("btnToggleSidebar");

  btnToggleSidebar.onclick = function () {
    sidebar.classList.toggle("collapsed");
  };

  const btnToggleTheme = document.getElementById("btnToggleTheme");
  btnToggleTheme.onclick = function () {
    const body = document.body;
    body.classList.toggle("dark-theme");
    if (
      btnToggleTheme.getAttribute("src") ==
      "../../public/assets/img/modo_claro.svg"
    ) {
      btnToggleTheme.setAttribute(
        "src",
        "../../public/assets/img/modo_oscuro.svg"
      );
    } else {
      btnToggleTheme.setAttribute(
        "src",
        "../../public/assets/img/modo_claro.svg"
      );
    }
  };

  const cards = document.getElementsByClassName("card");
  for (let i = 0; i < cards.length; i++) {
    cards[i].onclick = function () {
      this.style.transition = "transform 0.3s ease";
      this.style.transform = "scale(1.05)";
      setTimeout(() => {
        this.style.transform = "scale(1)";
      }, 300);
    };
  }

  const barras = document.querySelectorAll(".sub_barra");
  const valores = [35, 45, 55, 75, 85];
  const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo"];
  const mesMap = {
    Enero: "01",
    Febrero: "02",
    Marzo: "03",
    Abril: "04",
    Mayo: "05",
  };

  barras.forEach((barra, i) => {
    barra.style.height = "0px";
    barra.style.transition = "height 1s ease-out " + i * 0.2 + "s";
    setTimeout(() => {
      barra.style.height = valores[i] + "%";
    }, 100);
  });

  barras.forEach((barra) => {
    const valor = barra.querySelector(".tag_g").textContent;
    barra.addEventListener("mouseenter", () => {
      const tooltip = document.createElement("div");
      tooltip.className = "tooltip";
      tooltip.innerText = valor;
      Object.assign(tooltip.style, {
        position: "absolute",
        background: "#333",
        color: "#fff",
        padding: "5px 10px",
        borderRadius: "8px",
        fontSize: "12px",
        pointerEvents: "none",
        zIndex: "999",
        animation: "fadein 0.3s ease-out",
      });
      document.body.appendChild(tooltip);
      barra.addEventListener("mousemove", (e) => {
        tooltip.style.left = e.pageX - 20 + "px";
        tooltip.style.top = e.pageY - 40 + "px";
      });
    });

    barra.addEventListener("mouseleave", () => {
      const tooltip = document.querySelector(".tooltip");
      if (tooltip) tooltip.remove();
    });
  });

  barras.forEach((barra, i) => {
    barra.style.height = "0px";
    barra.style.transition = "height 1s ease-out " + i * 0.2 + "s";
    setTimeout(() => {
      barra.style.height = valores[i] + "%";
    }, 100);
  });

  barras.forEach((barra) => {
    const valor = barra.querySelector(".tag_g").textContent;
    barra.addEventListener("mouseenter", () => {
      const tooltip = document.createElement("div");
      tooltip.className = "tooltip";
      tooltip.innerText = valor;
      Object.assign(tooltip.style, {
        position: "absolute",
        background: "#333",
        color: "#fff",
        padding: "5px 10px",
        borderRadius: "8px",
        fontSize: "12px",
        pointerEvents: "none",
        zIndex: "999",
        animation: "fadein 0.3s ease-out",
      });

      document.body.appendChild(tooltip);
      barra.addEventListener("mousemove", (e) => {
        tooltip.style.left = e.pageX - 20 + "px";
        tooltip.style.top = e.pageY - 40 + "px";
      });
    });

    barra.addEventListener("mouseleave", () => {
      const tooltip = document.querySelector(".tooltip");
      if (tooltip) tooltip.remove();
    });
  });

  const eventos = document.querySelectorAll(".event");
  let minDiff = Infinity;
  let proximo = null;
  const hoy = new Date();

  eventos.forEach((evento) => {
    const fechaTexto = evento.querySelector(".fechaEvento").textContent;
    const [dia, mes, anio] = fechaTexto.split("/");
    const fechaEvento = new Date(`${anio}-${mes}-${dia}`);
    const diff = fechaEvento - hoy;
    if (diff > 0 && diff < minDiff) {
      minDiff = diff;
      proximo = evento;
    }
  });

  if (proximo) {
    proximo.style.border = "2px solid #D81159";
    proximo.style.backgroundColor = "#ffeaf0";
  }

  barras.forEach((barra, i) => {
    barra.addEventListener("click", () => {
      const mesSeleccionado = mesMap[meses[i]];
      eventos.forEach((evento) => {
        const fechaTexto = evento.querySelector(".fechaEvento").textContent;
        const [_, mes, __] = fechaTexto.split("/");
        if (mes === mesSeleccionado) {
          evento.style.display = "block";
        } else {
          evento.style.display = "none";
          mostrarTodosBtn.style.display = "block";
        }
      });
    });
  });

  const mostrarTodosBtn = document.getElementById("mostrarTodos");
  mostrarTodosBtn.addEventListener("click", () => {
    eventos.forEach((evento) => (evento.style.display = "block"));
    if (mostrarTodosBtn.style.display == "block") {
      mostrarTodosBtn.style.display = "none";
    }
  });
};
