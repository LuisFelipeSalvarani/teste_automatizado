<?php

function addMsgSucesso($msg) {
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => $msg
    ];
}

function addMsgErro($msg) {
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $msg
    ];
}