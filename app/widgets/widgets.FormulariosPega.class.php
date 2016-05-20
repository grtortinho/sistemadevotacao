
<?php

class FormulariosPega {

    function __construct() {
        
    }

    function post($name) {
        if (filter_has_var(INPUT_POST, $name)) {
            return filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            return '';
        }
    }

    function verificarPost($name) {
        if (filter_has_var(INPUT_POST, $name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function verificarGet($name) {
        if (filter_has_var(INPUT_GET, $name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get($name) {
        if (filter_has_var(INPUT_GET, $name)) {
            return filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            new Erro("Get {$name} não exite");
        }
    }

}
