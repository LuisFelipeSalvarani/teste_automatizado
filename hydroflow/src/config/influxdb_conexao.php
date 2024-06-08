<?php
// Inclui a biblioteca InfluxDB2 e suas dependências
require __DIR__ . '/../../vendor/autoload.php';

// Importa as classes necessárias para o InfluxDB
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;

// Configurações para acessar o InfluxDB
$org = 'FATEC'; // Nome da organização no InfluxDB
$bucket = 'Teste'; // Nome do bucket no InfluxDB
$token = 'JTJl4LF4xuW71lQCvdrdR3EgnDENxInACIYwfvOlnMZdQU4_c8GWbFJ7k9T9EP-qg63IWzGM9jQxidJFviszjQ=='; // Token de autenticação

// Cria uma instância do cliente InfluxDB
$client = new Client([
    "url" => "http://192.168.1.10:8086", // URL do servidor InfluxDB
    "token" => $token, // Token de autenticação
    "bucket" => $bucket, // Nome do bucket
    "org" => $org, // Nome da organização
    "precision" => WritePrecision::S // Precisão da escrita (segundos)
]);