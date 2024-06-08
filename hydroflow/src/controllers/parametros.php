<?php
session_start();
requireValidSession();

loadModel("Jardim");

$exception = null;

// if(count($_POST) > 0) {
//     try {
//         $novoDispositivo = new Dispositivo($_POST);
//         $novoDispositivo->inserir();
//         addMsgSucesso("Dispositivo cadastrado com sucesso");
//         $_POST = [];
//     } catch(Exception $e) {
//         $exception = $e;
//     }
// }

$jardins = Jardim::get([], 'id, nome_jardim');

loadTemplateView("parametros", $_POST = [
    'nomeCss' => 'cadastro',
    'exception' => $exception,
    'jardins' => $jardins
]);