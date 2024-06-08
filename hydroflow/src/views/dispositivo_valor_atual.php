<main class="main">
    <?php
    renderTitle(
        "Painel de Controle",
        "Controles dos dispositivos",
        "faders"
    );
    ?>

    <div id="valores">
        <h2>Últimos Valores do InfluxDB</h2>
        <ul id="lista-valores">
            <!-- Os valores serão inseridos aqui -->
        </ul>
    </div>
</main>
<script src="/assets/js/progressBar.js"></script>
<!-- Inclui a biblioteca ECharts -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.0/dist/echarts.min.js"></script>
<!-- Inclui a biblioteca jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclui o arquivo JavaScript externo para a lógica do gráfico -->
<script src="/assets/js/dispositivos_valor_atual.js"></script>