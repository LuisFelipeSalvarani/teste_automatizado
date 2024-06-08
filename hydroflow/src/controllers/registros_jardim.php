<?php
session_start();
requireValidSession();

loadModel("Jardim");
loadModel("Zona");

$jardins = Jardim::get();
$zonas = Zona::get();

loadTemplateView("registros_jardim", [
    'nomeCss' => 'registro',
    'jardins' => $jardins,
    'zonas' => $zonas
]);