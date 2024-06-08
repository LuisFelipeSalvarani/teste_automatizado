(() => {
    const inputArea = document.querySelector('#id_area');

    inputArea.addEventListener('change', async () => {
        let idArea = inputArea.value;
        const response = await fetch(`consultar_parametros.php?id_area=${idArea}`);
        
        if(response.ok) {
            const data = await response.json();

            if (data != null) {
                document.querySelector('#id_parametros').value = data.id_parametros;
                document.querySelector('#hora_inicio').value = data.hora_inicio;
                document.querySelector('#duracao').value = data.duracao;
                document.querySelector('#min_umidade').value = data.min_umidade;
                document.querySelector('#max_umidade').value = data.max_umidade;
                document.querySelector('#min_temperatura').value = data.min_temperatura;
                document.querySelector('#max_temperatura').value = data.max_temperatura;
                document.querySelector('#min_volume').value = data.min_volume;
                document.querySelector('#max_volume').value = data.max_volume;
                document.querySelector('#segunda').checked = data.segunda == 1 ? true : false;
                document.querySelector('#terca').checked = data.terca == 1 ? true : false;
                document.querySelector('#quarta').checked = data.quarta == 1 ? true : false;
                document.querySelector('#quinta').checked = data.quinta == 1 ? true : false;
                document.querySelector('#sexta').checked = data.sexta == 1 ? true : false;
                document.querySelector('#sabado').checked = data.sabado == 1 ? true : false;
                document.querySelector('#domingo').checked = data.domingo == 1 ? true : false;
            } else {
                document.querySelector('#id_parametros').value = '';
                document.querySelector('#hora_inicio').value = '';
                document.querySelector('#duracao').value = '';
                document.querySelector('#min_umidade').value = '';
                document.querySelector('#max_umidade').value = '';
                document.querySelector('#min_temperatura').value = '';
                document.querySelector('#max_temperatura').value = '';
                document.querySelector('#min_volume').value = '';
                document.querySelector('#max_volume').value = '';
                document.querySelector('#segunda').checked = true;
                document.querySelector('#terca').checked = true;
                document.querySelector('#quarta').checked = true;
                document.querySelector('#quinta').checked = true;
                document.querySelector('#sexta').checked = true;
                document.querySelector('#sabado').checked = true;
                document.querySelector('#domingo').checked = true;
            }
        }
    });
})()