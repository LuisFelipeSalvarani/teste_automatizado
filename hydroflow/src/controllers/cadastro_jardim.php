<?php
session_start();
requireValidSession();

loadModel("Jardim");
loadModel("Zona");

$exception = null;

if(count($_POST) > 0) {
    try {
        $zona = [];
        for ($contador = 0; $contador <= $_POST['contador']; $contador++){
    
            foreach($_POST as $chave => $valor) {
                if(strpos("$chave", $contador)) {
                    unset($_POST[$chave]);
                    if(strpos("$chave", "nome_zona") !== false){
                        $zona['nome_zona'] .= $valor;
                    } elseif($contador == 0) {
                        $jardim[substr($chave, 0, -1)] = $valor;
                    } else {
                        $zona[substr($chave, 0, -1)] = $valor;
                    }
                }
            }
            if($contador == 0) {
                $novoJardim = new Jardim($jardim);
                $novoJardim->inserir();
            } else {
                $jardins = Jardim::getOne([],'max(id) as id');
                $zona['id_jardim'] = $jardins->id;
                $novaZona = new Zona($zona);
                $novaZona->inserir();
                unset($zona);
            }
        }
        addMsgSucesso("Jardim e suas zonas cadastrados com sucesso");
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    }
}

$tipoIrrigacoes = Jardim::getFromOtherTable("tiposirrigacoes");
$tipoPlantas = Jardim::getFromOtherTable("tiposplantas");

loadTemplateView("cadastro_jardim", $_POST = [
    'nomeCss' => 'cadastro',
    'exception' => $exception,
    'tipoIrrigacoes' => $tipoIrrigacoes,
    'tipoPlantas' => $tipoPlantas
]);