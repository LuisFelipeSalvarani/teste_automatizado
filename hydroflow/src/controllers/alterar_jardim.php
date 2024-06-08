<?php
session_start();
requireValidSession();

loadModel("Jardim");
loadModel("Zona");

$exception = null;
$dados = [];

if(isset($_GET['delete'])){
    try {
        Zona::deleteByIdJardim($_GET['delete']);
        Jardim::deleteById($_GET['delete']);
        addMsgSucesso('Jardim e suas zonas foram excluidos com sucesso');
        header('Location: registros_jardim.php');
        exit();
    } catch (Exception $e) {
        $exception = $e;
        addErrorMsg('Não foi possível excluir o jardim');
    }
} elseif(count($_POST) === 0 && isset($_GET['update'])) {
    $jardim = Jardim::getOne(['id' => $_GET['update']]);
    $dados = $jardim->getValues();
} elseif(count($_POST) > 0) {
    try {
        $attJardim = new Jardim($_POST);
        $attJardim->alterar();
        addMsgSucesso("Jardim atualizado com sucesso");
        header('Location: registros_jardim.php');
        exit();
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $dados = $_POST;
    }
}

$zonas = Zona::get(['id_jardim' => $_GET['update']]);
$tipoIrrigacoes = Jardim::getFromOtherTable("tiposirrigacoes");
$tipoPlantas = Jardim::getFromOtherTable("tiposplantas");

loadTemplateView("alterar_jardim", $dados + [
    'nomeCss' => ['cadastro'],
    'exception' => $exception,
    'zonas' => $zonas,
    'tipoIrrigacoes' => $tipoIrrigacoes,
    'tipoPlantas' => $tipoPlantas
]);