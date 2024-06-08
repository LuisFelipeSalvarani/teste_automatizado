<main class="main">
    <?php
    renderTitle(
        "Painel de Controle",
        "Controles dos dispositivos",
        "faders"
    );
    ?>

<div id="echarts_grafico_linha" style="width: auto; height: 400px;"></div><br><br>

    <div id="echarts_grafico_barra" style="width: auto; height: 400px;"></div>
</main>
<script src="/assets/js/progressBar.js"></script>
<!-- Inclui a biblioteca ECharts -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.0/dist/echarts.min.js"></script>
<!-- Inclui a biblioteca jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclui o arquivo JavaScript externo para a lógica do gráfico -->
<script src="/assets/js/echart_grafico_linha.js"></script>
<script src="/assets/js/echart_grafico_barra.js"></script>