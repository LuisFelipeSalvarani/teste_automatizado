$(document).ready(function() {
    $.ajax({
        url: 'influxdb_query.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#lista-valores').empty();

            // Array para armazenar séries de dados para cada métrica
            var seriesData = [];

            // Itera sobre as chaves do objeto data (cada chave é um timestamp)
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    // Adiciona um ponto de dados para cada métrica
                    for (var metric in data[key]) {
                        if (data[key].hasOwnProperty(metric) && metric !== 'time') {
                            // Verifica se já existe uma série de dados para esta métrica
                            var seriesIndex = seriesData.findIndex(function(series) {
                                return series.name === metric;
                            });

                            // Se não existir, cria uma nova série de dados
                            if (seriesIndex === -1) {
                                seriesData.push({
                                    name: metric,
                                    type: 'line',
                                    data: []
                                });
                                seriesIndex = seriesData.length - 1;
                            }

                            // Adiciona o ponto de dados à série de dados correspondente
                            seriesData[seriesIndex].data.push([data[key]['time'], data[key][metric]]);
                        }
                    }
                }
            }

            // Configuração das opções do gráfico ECharts
            var options = {
                backgroundColor: 'transparent',
                tooltip: {
                    trigger: 'axis',
                },
                legend: {
                    textStyle: {
                        color: 'rgba(128, 128, 128, .9)',
                    },
                },
                toolbox: {
                    feature: {
                        dataZoom: {
                            yAxisIndex: 'none',
                            icon: {
                                zoom: 'path://',
                                back: 'path://',
                            },
                        },
                        saveAsImage: {},
                    }
                },
                xAxis: {
                    type: 'time',
                },
                yAxis: {
                    type: 'value',
                    min: 'dataMin',
                },
                grid: {
                    left: '2%',
                    right: '2%',
                    top: '2%',
                    bottom: 24,
                    containLabel: true,
                },
                series: seriesData
            };

            // Inicializa o gráfico ECharts com as opções configuradas
            var chart = echarts.init(document.getElementById('echarts_grafico_linha'));
            chart.setOption(options);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar os valores do InfluxDB:', error);
        }
    });
});
