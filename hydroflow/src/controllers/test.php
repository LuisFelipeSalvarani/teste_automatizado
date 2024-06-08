<?php

loadModel('Dispositivo');

$result = Dispositivo::getFromInner([], [
    'zonas' => 'dispositivos.id_zona = zonas.id',
    'jardins' => 'zonas.id_jardim = jardins.id'
]);

print_r($result);