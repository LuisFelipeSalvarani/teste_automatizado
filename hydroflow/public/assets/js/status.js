(function () {
    let area = document.getElementById("id_area");
    let jardim = document.getElementById("id_jardim");
    let controles = document.querySelector(".control-box");
    area.addEventListener("change", async () => {
      var areaValor = area.value;
      var jardimValor = jardim.value;
      const response = await fetch("status_sistema.php?jardim=" + jardimValor + "&area=" + areaValor);
  
      if (response.ok) {
        const data = await response.json();
        
        if (data === null) {
            document.getElementById("automatico").checked = false;
            document.getElementById("valvula").checked = false;
            document.getElementById("motor").checked = false;
            document.getElementById("controle_temperatura").checked = false;
            document.getElementById("controle_umidade").checked = false;
            document.getElementById("controle_consumo").checked = false;
            if (controles.classList.contains("visivel")) controles.classList.remove("visivel");
        } else {
          document.getElementById("automatico").checked = data.automatico == 1 ? true : false;
          document.getElementById("valvula").checked = data.valvula == 1 ? true : false;
          document.getElementById("motor").checked = data.motor == 1 ? true : false;
          document.getElementById("controle_temperatura").checked = data.controle_temperatura == 1 ? true : false;
          document.getElementById("controle_umidade").checked = data.controle_umidade == 1 ? true : false;
          document.getElementById("controle_consumo").checked = data.controle_consumo == 1 ? true : false;
          if (!controles.classList.contains("visivel")) controles.classList.add("visivel");
        }
      }
    });
  })();