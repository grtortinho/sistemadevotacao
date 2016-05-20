<?php

abstract class Conexao {

    private $pdo;

    protected function conectar() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;charset=UTF8;dbname=cepc", "root", "");
            $this->pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $ex) {
            New Erro($ex->getMessage());
        }
        return $this->pdo;
    }

    protected function iniciarTransacoes() {
        $this->pdo->beginTransaction();
    }

    protected function finalizarTransacoes() {
        $this->pdo->commit();
    }

    protected function desconectar() {
        $this->pdo = NULL;
    }

}
