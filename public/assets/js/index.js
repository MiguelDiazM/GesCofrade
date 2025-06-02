window.onload = function () {
  let authArea = document.getElementById("authArea");
  let userIcon = document.getElementById("userIcon");
  let dropdownMenu = document.getElementById("dropdownMenu");
  
  if (userIcon) {
    userIcon.onclick = function () {
    dropdownMenu.style.display =
      dropdownMenu.style.display === "block" ? "none" : "block";
  };

  document.addEventListener("click", function (e) {
    if (!authArea.contains(e.target)) {
      dropdownMenu.style.display = "none";
    }
  });
  }
  

  var articles = document.querySelectorAll(".suscription");

  for (var i = 0; i < articles.length; i++) {
    articles[i].onmouseover = function () {
      this.style.transform = "scale(1.05)";
      this.style.transition = "transform 0.5s ease";

      var h1 = this.querySelector("h1");
      var p = this.querySelector("p");

      h1.style.color = "#FFBC42";
      p.style.color = "#FFBC42";
    };

    articles[i].onmouseout = function () {
      this.style.transform = "scale(1)";

      var h1 = this.querySelector("h1");
      var p = this.querySelector("p");

      h1.style.color = "";
      p.style.color = "";
    };
  }

  var starsContainers = document.querySelectorAll(".stars");

  for (var i = 0; i < starsContainers.length; i++) {
    var rating = parseInt(starsContainers[i].getAttribute("data-rating"));
    var starsHtml = "";

    for (var j = 0; j < 5; j++) {
      if (j < rating) {
        starsHtml += "★";
      } else {
        starsHtml += "☆";
      }
    }

    starsContainers[i].innerHTML = starsHtml;
  }
};
