<?php

$contador = isset($_GET['contador']) ? $_GET['contador'] : 2;

loadModel("Jardim");

$tipoIrrigacoes = Jardim::getFromOtherTable("tiposirrigacoes");
$tipoPlantas = Jardim::getFromOtherTable("tiposplantas");

$html = '
<h2 class="title secundario"><i class="ph-bold ph-flag"></i>Zona  ' . $contador . '</h2>
<div class="form-group">
    <div class="input-field duplo-select">
        <label for="nome_zona">Nome da Zona</label>
        <div class="duplo-select">
            <select class="input" name="nome_zona_let' . $contador . '" id="nome_zona">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
                <option value="e">E</option>
                <option value="f">F</option>
                <option value="g">G</option>
                <option value="h">H</option>
                <option value="i">I</option>
                <option value="j">J</option>
            </select>
            <select class="input" name="nome_zona_num' . $contador . '" id="nome_zona">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>
    <div class="input-field flex-5">
        <label for="tipo_planta">Tipo de Planta</label>
        <select class="input" name="id_tipo_planta' . $contador . '" id="tipo_planta">';
          foreach($tipoPlantas as $tipoPlanta) {
              $html .= '<option value="' . $tipoPlanta->id . '">' . $tipoPlanta->nome_tipo_planta . '</option>';
          }
$html .= '  </select>
            <div class="invalid-feedback">
            </div>
        </div>
        <div class="input-field flex-5">
            <label for="tipo_irrigacao">Tipo Irrigação</label>
            <select class="input" name="id_tipo_irrigacao' . $contador . '" id="tipo_irrigacao">';
            foreach($tipoIrrigacoes as $tipoIrrigacao) {
                $html .= '<option value="' . $tipoIrrigacao->id . '">' . $tipoIrrigacao->nome_tipo_irrigacao . '</option>';
            }
        
$html .= '          </select>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="descricao_zona">Descrição</label>
                    <textarea class="input textarea" name="descricao_zona' . $contador . '" id="descricao_zona" cols="30" rows="10"></textarea>
                </div>
            </div>
';

echo $html;