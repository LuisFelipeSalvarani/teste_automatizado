(function () {
  var contador = 2;
  var addButton = document.querySelector(".btn-add");
  var contadorInput = document.getElementById("contador");

  addButton.addEventListener(
    "click",
    async function () {
      const response = await fetch("gerar_campos.php?contador=" + contador);

      if (response.ok) {
        const htmlToAdd = await response.text();
        addButton.insertAdjacentHTML("beforebegin", htmlToAdd);
        contadorInput.value = contador;
        contador++;
      }
    }
  );
})();
