<?php

// Cria uma instância da API de consulta
$queryApi = $client->createQueryApi();

// Realiza uma consulta no banco de dados InfluxDB
$result = $queryApi->query('from(bucket: "irrigationIDB") |> range(start: -5m) |> filter(fn: (r) => r["_measurement"] == "irrigacao") 
|> filter(fn: (r) => r["_field"] == "consumo_agua")
|> filter(fn: (r) => r["id_area"] == "20") |> filter(fn: (r) => r["id_jardim"] == "6") |> yield(name: "mean")');

// Inicializa um array para armazenar os dados do gráfico
$echartsData = [];

// Processa os resultados da consulta e formata os dados
foreach ($result[0]->records as $record) {
    $time = $record["_time"];
    $consumoAgua = $record["_value"];
    $echartsData[] = [
        'time' => $time,
        'value' => $consumoAgua
    ];
}

// Fecha a conexão com o InfluxDB
$client->close();

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Envia os dados no formato JSON como resposta
echo json_encode($echartsData);
