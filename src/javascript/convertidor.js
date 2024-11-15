document.getElementById("userForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("/src/php/procesar_formulario.php", {
      method: "POST",
      body: formData,
  })
  .then(response => response.text())
  .then(data => {
      document.getElementById("msg_sucess").innerHTML = data;
  })
  .catch(error => {
      console.error("Error:", error);
  });
});
