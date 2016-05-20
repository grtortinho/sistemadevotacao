<?php

abstract class Secao {

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    protected function criarSecao($nome, $valor) {
        if (!$this->verificarSecao($nome)) {
            $_SESSION[$nome] = $valor;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function alterarSecao($nome, $valor) {
        if ($this->verificarSecao($nome)) {
            $_SESSION[$nome] = $valor;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function apagarSecao($nome) {
        if ($this->verificarSecao($nome)) {
            unset($_SESSION[$nome]);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function verificarSecao($nome) {
        if (isset($_SESSION[$nome])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function getSecao($nome) {
        if (isset($_SESSION[$nome])) {
            return $_SESSION[$nome];
        } else {
            return FALSE;
        }
    }

}
