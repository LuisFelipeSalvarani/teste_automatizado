// Inicializa o gráfico ECharts no elemento HTML com o ID "echarts"
var chart = echarts.init(document.getElementById('echarts_grafico_barra'));

// Função para obter os dados do back-end com base na consulta selecionada
//function fetchCategory(consultaSelecionada) {
$.ajax({
    // Substitua pela URL apropriada para o seu back-end
    url: 'influxdb_query_consumo.php',
    type: 'GET',
    dataType: 'json',
    async: false, // Define a solicitação como síncrona

    success: function (data) {
        // Os dados obtidos do servidor são armazenados na variável "data"
        var echartsData = data;

        // Configuração das opções do gráfico ECharts
        var options = {
            xAxis: {
                type: 'category',
                data: echartsData.map(function (data) {
                    return data.time;
                }),
            },
            yAxis: {
                type: 'value',
            },
            series: [
                {
                    name: 'Consumo de Água',
                    type: 'bar', // Alterado para 'bar' para corresponder aos seus dados
                    data: echartsData.map(function (data) {
                        return data.value.toFixed(2);
                    }),
                },
            ],
        };

        // Define as opções no gráfico ECharts
        chart.setOption(options);
    },
    error: function (xhr, status, error) {
        // Se ocorrer um erro na solicitação AJAX, exibe uma mensagem de erro no console
        console.error('Erro na solicitação AJAX: ' + error);
    }
});
