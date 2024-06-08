(function () {
    let zona = document.getElementById("id_area");
    let zonaValor = document.getElementById("areaValor");
    let jardim = document.getElementById("id_jardim");

    window.addEventListener('load', async function() {
      if(jardim.value != null) {
        let jardimValor = jardim.value;
        zonaValor = zonaValor.value;
        const response = await fetch("select_zona.php?id=" + jardimValor + "&id_zona=" + zonaValor);
        
        if (response.ok) {
          const htmlToAdd = await response.text();
          zona.innerHTML = htmlToAdd;
          // zona.insertAdjacentHTML("beforeend", htmlToAdd);
          return;
        }
      }
    })

    jardim.addEventListener("change", async function() {
      let jardimValor = jardim.value;
      const response = await fetch("select_zona.php?id=" + jardimValor);
  
      if (response.ok) {
        const htmlToAdd = await response.text();
        zona.innerHTML = htmlToAdd;
        // zona.insertAdjacentHTML("beforeend", htmlToAdd);
      }
    });
})();