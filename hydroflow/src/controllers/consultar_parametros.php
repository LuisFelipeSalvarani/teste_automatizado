<?php

loadModel("Parametro");

$parametros = Parametro::getCheckboxesValues(['id_area' => $_GET['id_area']]);

echo json_encode($parametros);