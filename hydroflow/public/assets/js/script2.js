function enviarComandos() {
    // Construir a URL com base nos valores dos campos
    var id_jardim = document.getElementById('id_jardim').value;
    var id_area = document.getElementById('id_area').value;
    var url = `http://192.168.1.10:1880/irrigacao/comando/${id_jardim}/${id_area}`;

    // Construir o objeto de dados com as informações do formulário
    var comandos = {
        descricao: "Status do sistema",
        id_jardim: id_jardim,
        id_area: id_area,
        automatico: document.getElementById('automatico').checked,
        valvula: document.getElementById('valvula').checked,
        motor: document.getElementById('motor').checked,
        controle_temperatura: document.getElementById('controle_temperatura').checked,
        controle_umidade: document.getElementById('controle_umidade').checked,
        controle_consumo: document.getElementById('controle_consumo').checked
    };

    // Enviar os dados do formulário via fetch com método PUT
    fetch(url, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(comandos)
    });
}

function getMessage(message) {
    let tag = document.createElement('h2');
    tag.innerText = message;
    return tag;
}

const modal = document.querySelector("#confirm-modal");
const successModal = document.querySelector("#success-modal");
const errorModal = document.querySelector("#error-modal");
const textSuccessModal = successModal.querySelector('h2');
const textErrorModal = errorModal.querySelector('h2');

document.querySelector("#confirm-modal #close").addEventListener('click', () => {
    modal.close();
})

document.getElementById("register").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita o comportamento padrão de enviar o formulário

    // Construir a URL com base nos valores dos campos
    var id_jardim = document.getElementById('id_jardim').value;
    var id_area = document.getElementById('id_area').value;
    var url = `http://192.168.1.10:1880/irrigacao/parametro/${id_jardim}/${id_area}`;
    let reload;
    let idParametros = document.getElementById('id_parametros').value;

    // Construir o objeto de dados com as informações do formulário
    if (idParametros) {
        var jsonData = {
            // descricao: "Parâmetros do Sistema",
            id_parametros: document.getElementById('id_parametros').value,
            id_jardim: document.getElementById('id_jardim').value,
            id_area: document.getElementById('id_area').value,
            hora_inicio: document.getElementById('hora_inicio').value,
            duracao: document.getElementById('duracao').value,
            max_umidade: document.getElementById('max_umidade').value,
            min_umidade: document.getElementById('min_umidade').value,
            max_temperatura: document.getElementById('max_temperatura').value,
            min_temperatura: document.getElementById('min_temperatura').value,
            max_volume: document.getElementById('max_volume').value,
            min_volume: document.getElementById('min_volume').value,
            segunda: document.getElementById('segunda').checked ? 1 : 0,
            terca: document.getElementById('terca').checked ? 1 : 0,
            quarta: document.getElementById('quarta').checked ? 1 : 0,
            quinta: document.getElementById('quinta').checked ? 1 : 0,
            sexta: document.getElementById('sexta').checked ? 1 : 0,
            sabado: document.getElementById('sabado').checked ? 1 : 0,
            domingo: document.getElementById('domingo').checked ? 1 : 0,
        };
    } else {
        var jsonData = {
            // descricao: "Parâmetros do Sistema",
            id_jardim: document.getElementById('id_jardim').value,
            id_area: document.getElementById('id_area').value,
            hora_inicio: document.getElementById('hora_inicio').value,
            duracao: document.getElementById('duracao').value,
            max_umidade: document.getElementById('max_umidade').value,
            min_umidade: document.getElementById('min_umidade').value,
            max_temperatura: document.getElementById('max_temperatura').value,
            min_temperatura: document.getElementById('min_temperatura').value,
            max_volume: document.getElementById('max_volume').value,
            min_volume: document.getElementById('min_volume').value,
            segunda: document.getElementById('segunda').checked ? 1 : 0,
            terca: document.getElementById('terca').checked ? 1 : 0,
            quarta: document.getElementById('quarta').checked ? 1 : 0,
            quinta: document.getElementById('quinta').checked ? 1 : 0,
            sexta: document.getElementById('sexta').checked ? 1 : 0,
            sabado: document.getElementById('sabado').checked ? 1 : 0,
            domingo: document.getElementById('domingo').checked ? 1 : 0,
        };
    }

    fetch('gravar_parametros.php', {
        method: "POST",
        headers: {
            "Content-Type" : "application/json"
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Erro HTTP:' + response.status);
        }
        return response.json()
    })
    .then(function(data) {
        if(!data.success) throw new Error(data.message || 'Erro na inserção');
        modal.showModal();
        return new Promise((resolve, reject) => {
            const modalCarregar = document.querySelector("#modal-carregar");
            const modalSalvar = document.querySelector("#modal-salvar");

            modalCarregar.addEventListener('click', () => {
                modal.close();
                resolve('carregar');
            })

            modalSalvar.addEventListener('click', () => {
                modal.close();
                reject('salvar');
            })
        })
        return data;
    })
    .then(choice => {
        if(choice === 'carregar') {
            // Enviar os dados do formulário via fetch com método PUT
            fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(jsonData)
            })
            .then(() => {
                window.location.reload(false);
            })
            .catch(() => {
                alert('erro ao gravar no dispositivo')
            });
        }
    })
    .catch(reason => {
        if(reason === 'salvar') {
            modal.close();
            textSuccessModal.innerText = 'Dados inseridos com sucesso';
            setTimeout(() => successModal.showModal(), 1000);
            setTimeout(() => successModal.close(), 4000);
        } else {
            textErrorModal.innerText = 'Erro ao inserir os dados';
            errorModal.showModal();
            setTimeout(() => errorModal.close(), 3000);
        }
    });
});