<?php
session_start();
requireValidSession();

loadModel("Jardim");

$jardins = Jardim::get();

loadTemplateView("painel_controle", [
    'nomeCss' => 'controle',
    'jardins' => $jardins
]);