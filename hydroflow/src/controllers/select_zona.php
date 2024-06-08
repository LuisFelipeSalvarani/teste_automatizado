<?php

loadModel("Zona");

$zonas = Zona::get(['id_jardim' => $_GET['id']], 'id, nome_zona');
$id = $_GET['id_zona'];

$html = "<option value=''>Selecione uma Zona...</option>";

foreach($zonas as $zona){
    $selected = $id == $zona->id ? 'selected' : '';
    $html .= "<option value='{$zona->id}' {$selected}>{$zona->nome_zona}</option>";
}

echo $html;