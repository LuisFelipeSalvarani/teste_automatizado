<?php
session_start();
requireValidSession();

loadModel("Dispositivo");
loadModel("Zona");
loadModel("Jardim");

if($_GET['filtro']) {
    $ordem = $_GET['ordem'] ? $_GET['ordem'] : '';
    $dispositivos = Dispositivo::getFromInner([], [
        'zonas' => 'dispositivos.id_zona = zonas.id',
        'jardins' => 'zonas.id_jardim = jardins.id'
    ],
    "{$_GET['filtro']} {$ordem}");
} else {
    $dispositivos = Dispositivo::getFromInner([], [
        'zonas' => 'dispositivos.id_zona = zonas.id',
        'jardins' => 'zonas.id_jardim = jardins.id'
    ], "dispositivos.id_dispositivo");
}

// $jardins = Jardim::get([], 'id, nome_jardim');
// $zonas = Zona::get([], 'id, nome_zona, id_jardim');
$tipo_dispositivos = Dispositivo::getTipoDispositivo();

loadTemplateView("registros_dispositivo", [
    'nomeCss' => 'registro',
    'dispositivos' => $dispositivos,
    'jardins' => $jardins,
    'zonas' => $zonas,
    'tipo_dispositivos' => $tipo_dispositivos
]);