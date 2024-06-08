<?php

function requireValidSession() {
    $user = $_SESSION['usuario'];
    if(!isset($user)) {
        header('Location: login.php');
        exit();
    }
}