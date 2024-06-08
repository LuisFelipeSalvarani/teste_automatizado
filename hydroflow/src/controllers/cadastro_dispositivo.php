<?php
session_start();
requireValidSession();

loadModel("Dispositivo");
loadModel("Jardim");
loadModel("Zona");

$exception = null;
$dados = [];

if(isset($_GET['delete'])){
    try {
        Dispositivo::deleteByIdDipositivo($_GET['delete']);
        addMsgSucesso('Dispositivo foi excluido com sucesso');
        header('Location: registros_dispositivo.php');
        exit();
    } catch (Exception $e) {
        $exception = $e;
        addMsgErro('Não foi possível excluir o dispositivo');
        header("Location: cadastro_dispositivo.php?update=" . $_GET['delete']);
        exit();
    }
} elseif(count($_POST) === 0 && isset($_GET['update'])){
    $dispositivo = Dispositivo::getOne(['id_dispositivo' => $_GET['update']]);
    $dados = $dispositivo->getValues();
    $id_jardim = Zona::getOne(['id' => $dados['id_zona']], 'id_jardim');
    $id = $id_jardim->getValues();
    $dados['id_jardim'] = $id['id_jardim'];
} elseif(count($_POST) > 0) {
    try {
        $novoDispositivo = new Dispositivo($_POST);
        if($novoDispositivo->id){
            $novoDispositivo->alterar();
            addMsgSucesso("Dispositivo atualizado com sucesso");
            header("Location: registros_dispositivo.php");
            exit();
        } else {
            $novoDispositivo->inserir();
            addMsgSucesso("Dispositivo cadastrado com sucesso");
            header("Location: registros_dispositivo.php");
            exit();
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $dados = $_POST;
    }
}

$tipoDispositivos = Dispositivo::getFromOtherTable("tiposdispositivos");
$jardins = Jardim::get([], 'id, nome_jardim');

loadTemplateView("cadastro_dispositivo", $dados + [
    'nomeCss' => 'cadastro',
    'exception' => $exception,
    'tipoDispositivos' => $tipoDispositivos,
    'jardins' => $jardins
]);