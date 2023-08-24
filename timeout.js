document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup");
    popup.style.display = "block";
    setTimeout(function () {
      popup.style.display = "none";
    }, 5000);
  });
  