<?php

abstract class Base extends Conexao {

    private $tabela;
    private $transacoes;
    private $pdo;

    protected function __construct($tabela, $Transacoes = FALSE) {
        $this->tabela = $this->expandir($tabela);
        $this->transacoes = $Transacoes;
    }

    function setTransacoes($transacoes) {
        $this->transacoes = $transacoes;
    }

    private function expandir($valor, $inicio = "", $fim = "") {
        if (!empty($valor)) {
            if (gettype($valor) == "array") {
                return $inicio . implode($valor, ",") . $fim;
            } else {
                return $inicio . $valor . $fim;
            }
        } else {
            return"";
        }
    }

    function getPdo() {
        return $this->pdo;
    }

    function setPdo($pdo) {
        $this->pdo = $pdo;
    }

    protected function insertBase($valores, $campos = '') {
        if (!$this->transacoes) {
            $this->pdo = $this->conectar();
        }
        if ($campos != '') {
            $campos = $this->expandir($campos, " (", ") ");
        }
        $tpm = '';
        if (gettype($valores) == "array") {
            $tpm = array();
            $tpm = $this->expandir(array_pad($tpm, (count($valores)), "?"), ' values(', ')');
        } else {
            $tpm = ' values(?)';
        }
        $sql = "insert into " . $this->tabela . $campos . $tpm;
        $consuta = $this->pdo->prepare($sql);
        $i = 1;
        if (gettype($valores) == "array") {
            foreach ($valores as $value) {
                $consuta->bindValue($i, $value, PDO::PARAM_STR);
                $i++;
            }
        } else {
            $consuta->bindValue($i, $valores, PDO::PARAM_STR);
        }
        $fim = $consuta->execute();
        if (!$this->transacoes) {
            $this->pdo = $this->desconectar();
        } else {
            if (!$fim) {
                $this->pdo->rollBack();
                new Erro("erro no db");
                die();
            }
        }
    }

    protected function selectBase($campos = '*', $conticao = '', $valores = null) {
        if (!$this->transacoes) {
            $this->pdo = $this->conectar();
        }
        if ($campos != '*') {
            $campos = $this->expandir($campos, "", " ");
        }
        if ($conticao != '') {
            $conticao = ' ' . $conticao;
        }
        $sql = "select " . $campos . 'from ' . $this->tabela . $conticao;
        $consuta = $this->pdo->prepare($sql);
        $i = 1;
        if ($valores != null) {
            if (gettype($valores) == "array") {
                foreach ($valores as $value) {
                    $consuta->bindValue($i, $value, PDO::PARAM_STR);
                    $i++;
                }
            } else {
                $consuta->bindValue($i, $valores, PDO::PARAM_STR);
            }
        }
        $consuta->execute();
        if (!$this->transacoes) {
            $this->pdo = $this->desconectar();
        }
        $fim = $consuta->fetchAll(PDO::FETCH_ASSOC);
        return $fim;
    }

    protected function updateBase($valores, $campos, $conticao = '') {
        if (!$this->transacoes) {
            $this->pdo = $this->conectar();
        }
        if ($conticao != '') {
            $conticao = ' ' . $conticao;
        }
        $set = array();
        if (gettype($campos) == "array") {
            for ($i = 0; $i < count($campos); $i++) {
                $set[] = $campos[$i] . '=?';
            }
        } else {
            $set = $campos . '=?';
        }
        $sql = "update " . $this->tabela . ' set ' . $this->expandir($set) .
                " " . $conticao;;
        $consuta = $this->pdo->prepare($sql);
        $i = 1;
        if (gettype($valores) == "array") {
            foreach ($valores as $value) {
                $consuta->bindValue($i, $value, PDO::PARAM_STR);
                $i++;
            }
        } else {
            $consuta->bindValue($i, $valores, PDO::PARAM_STR);
        }
        $fim = $consuta->execute();
        if (!$this->transacoes) {
            $this->pdo = $this->desconectar();
        } else {
            if (!$fim) {
                $this->pdo->rollBack();
                new Erro("erro no db");
                die();
            }
        }
    }

    protected function deleteBase($valores, $conticao) {
        if (!$this->transacoes) {
            $this->pdo = $this->conectar();
        }
        $sql = "delete from " . $this->tabela . ' ' . $conticao . '';
        $consuta = $this->pdo->prepare($sql);
        $i = 1;
        if (gettype($valores) == "array") {
            foreach ($valores as $value) {
                $consuta->bindValue($i, $value, PDO::PARAM_STR);
                $i++;
            }
        } else {
            $consuta->bindValue($i, $valores, PDO::PARAM_STR);
        }
        $consuta->execute();
        if (!$this->transacoes) {
            $this->pdo = $this->desconectar();
        }
    }

}
