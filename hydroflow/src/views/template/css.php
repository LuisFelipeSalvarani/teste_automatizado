<?php

if(is_array($nomeCss)) {
    foreach($nomeCss as $css) {
        echo '<link rel="stylesheet" href="/assets/css/' . $css . '.css">';
    }
} else {
    echo '<link rel="stylesheet" href="/assets/css/' . $nomeCss . '.css">';
}

?>