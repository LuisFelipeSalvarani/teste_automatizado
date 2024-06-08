<?php

// Cria uma instância da API de consulta
$queryApi = $client->createQueryApi();

// Realiza uma consulta no banco de dados InfluxDB
$result = $queryApi->query('from(bucket: "irrigationIDB") 
    |> range(start: -5m) |> filter(fn: (r) => r["_measurement"] == "irrigacao") |> filter(fn: (r) => r["_field"] == "consumo_agua" or r["_field"] == "motor" or r["_field"] == "temperatura" or r["_field"] == "umidade_ar" or r["_field"] == "umidade_solo" or r["_field"] == "valvula" or r["_field"] == "vazao") |> filter(fn: (r) => r["id_area"] == "' . $_GET['idArea'] . '") |> filter(fn: (r) => r["id_jardim"] == "' . $_GET['idJardim'] . '") |> last()');

// Inicializa um array para armazenar os dados do gráfico
$echartsData = [];

foreach ($result as $index => $records) {
    foreach ($records->records as $record) {
        $time = $record["_time"];
        $fieldName = $record["_field"];
        $value = $record["_value"];

        if (!isset($echartsData[$time])) {
            $echartsData[$time]['time'] = $time;
        }

        $echartsData[$time][$fieldName] = $value;
    }
}

// Fecha a conexão com o InfluxDB
$client->close();

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Envia os dados no formato JSON como resposta
echo json_encode($echartsData);