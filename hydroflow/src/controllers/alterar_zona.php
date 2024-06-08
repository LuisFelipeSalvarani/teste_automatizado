<?php
session_start();
requireValidSession();

loadModel("Jardim");
loadModel("Zona");

$exception = null;
$dados = [];

if(isset($_GET['delete']) && isset($_GET['jardim'])){
    try {
        Zona::deleteById($_GET['delete']);
        addMsgSucesso('Zona foi excluida com sucesso');
        header("Location: alterar_jardim.php?update={$_GET['jardim']}");
        exit();
    } catch (Exception $e) {
        $exception = $e;
        addErrorMsg('Não foi possível excluir a zona');
    }
} elseif(count($_POST) === 0 && isset($_GET['update'])){
    $zonas = Zona::getOne(['id' => $_GET['update']]);
    $dados = $zonas->getValues();
    $jardim = Jardim::getOne(['id' => $dados['id_jardim']], 'nome_jardim');
    $nomeJardim = $jardim->getValues();
    $dados['nome_jardim'] = $nomeJardim['nome_jardim'];
} elseif(count($_POST) > 0) {
    try {
        $_POST['nome_zona'] = $_POST['nome_zona_let'] . $_POST['nome_zona_num'];
        $attZona = new Zona($_POST);
        $attZona->alterar();
        addMsgSucesso("Zona atualizada com sucesso");
        header("Location: alterar_jardim.php?update={$_POST['id_jardim']}");
        exit();
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $dados = $_POST;
    }
}

$tipoIrrigacoes = Jardim::getFromOtherTable("tiposirrigacoes");
$tipoPlantas = Jardim::getFromOtherTable("tiposplantas");

loadTemplateView("alterar_zona", $dados + [
    'nomeCss' => ['cadastro'],
    'exception' => $exception,
    'tipoIrrigacoes' => $tipoIrrigacoes,
    'tipoPlantas' => $tipoPlantas
]);