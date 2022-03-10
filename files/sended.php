<?php

if (!empty($_FILES['files']['name'][0])) {
    echo '<ol>';
    foreach ($_FILES['files']['name'] as $file) {
        echo '<li>' . $file . '</li>';
    }
    echo '</ol>';
} else {
    echo '<h1>Nenhum arquivo enviado!</h1>';
}
