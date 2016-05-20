<?php

final class PessoaDao extends Base {

    public function __construct() {
        parent::__construct("pessoa");
        $this->conectar();
    }

    public function inserir($id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $fixo, $segmento) {
        $this->insertBase(array('null', date("Y-m-d H:i:s"),
            $id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $fixo, 0, $segmento));
    }
    public function inserirRetriagem($id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $fixo,$status, $segmento) {
        $this->insertBase(array('null', date("Y-m-d H:i:s"),
            $id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $fixo, $status, $segmento));
    }

    public function quantidadePorTipo($tipo) {
        $res = $this->selectBase("COUNT(*) as q", 'where status=? order by idusuario', $tipo);
        $q = 0;
        foreach ($res as $row) {
            $q = $row['q'];
        }
        return $q;
    }

    public function selectStatus($status, $inicio, $quantidade) {
        $res = $this->selectBase("*", "where status=? order by idusuario limit {$inicio},{$quantidade}", $status);
        $segmento = array();
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento[] = new Pessoas(
                    $row['id'], $row['data'], $row['idusuario'], $row['tipo'], $row['nome'], $row['nascimento'], $row['cpf'], $row['rg'], $row['orgao'], $row['celular'], $row['fixo'], $row['status'], $s->selectPorId($row['segmento']), $a->selectPorIdUsu($row['id']), $d->selectPorIdUsu($row['id']), $t->selectPorIdUsu($row['id']));
        }
        return $segmento;
    }
        public function quantidadePorSegmento($segmento) {
        $res = $this->selectBase("COUNT(*) as q", 'where tipo=1 and status>2 and segmento=?', $segmento);
        $q = 0;
        foreach ($res as $row) {
            $q = $row['q'];
        }
        return $q;
    }
    public function selectSegmentoCandidato($segmento, $inicio, $quantidade) {
        $res = $this->selectBase("*", "where tipo=1 and status>2 and segmento=? order by nome limit {$inicio},{$quantidade}", $segmento);
        $segmento = array();
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento[] = new Pessoas(
                    $row['id'], $row['data'], $row['idusuario'], $row['tipo'], $row['nome'], $row['nascimento'], $row['cpf'], $row['rg'], $row['orgao'], $row['celular'], $row['fixo'], $row['status'], $s->selectPorId($row['segmento']), $a->selectPorIdUsu($row['id']), $d->selectPorIdUsu($row['id']), $t->selectPorIdUsu($row['id']));
        }
        return $segmento;
    }

    public function selectId($id) {
        $res = $this->selectBase('*', 'where idusuario=? order by id desc limit 1', $id);
        $segmento = NULL;
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento = new Pessoas(
                    $row['id'], $row['data'], $row['idusuario'], $row['tipo'], $row['nome'], $row['nascimento'],
                     $row['cpf'], $row['rg'], $row['orgao'], $row['celular'], $row['fixo'], $row['status'],
                      $s->selectPorId($row['segmento']), $a->selectPorIdUsu($row['id']), 
                      $d->selectPorIdUsu($row['id']), $t->selectPorIdUsu($row['id']));
        }
        return $segmento;
    }
    public function selectIdmenor() {
        $res = $this->selectBase(array('tipo','idusuario','status','segmento','fixo','celular','nome'));
        $segmento = array();
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento[] = new Pessoas(
                    NULL,NULL,$row['idusuario'], $row['tipo'],$row['nome'],NULL,NULL,NULL,NULL,$row['celular'],
                    $row['fixo'], $row['status'],
                    $row['segmento'],NULL,NULL,NULL);
        }
        return $segmento;
    }

    public function selectIdmenor2() {
        $res = $this->selectBase('*');
        $segmento = array();
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento[] = new Pessoas(
                    $row['id'], $row['data'], $row['idusuario'], $row['tipo'], $row['nome'], $row['nascimento'],
                     $row['cpf'], $row['rg'], $row['orgao'], $row['celular'], $row['fixo'], $row['status'],
                      $s->selectPorId($row['segmento']), null, 
                      null, $t->selectPorIdUsu($row['id']));
        }
        return $segmento;
    }
    public function selectIdPessoa($id) {
        $res = $this->selectBase('*', 'where id=?', $id);
        $segmento = NULL;
        $a = new AnexoDao();
        $d = new DeclaracaoDao();
        $s = new SegmentoDao();
        $t = new TextoDao();
        foreach ($res as $row) {
            $segmento = new Pessoas(
                    $row['id'], $row['data'], $row['idusuario'], $row['tipo'], $row['nome'], $row['nascimento'], $row['cpf'], $row['rg'], $row['orgao'], $row['celular'], $row['fixo'], $row['status'], $s->selectPorId($row['segmento']), $a->selectPorIdUsu($row['id']), $d->selectPorIdUsu($row['id']), $t->selectPorIdUsu($row['id']));
        }
        return $segmento;
    }
    public function selectuId($idusu) {
        $res = $this->selectBase('id', 'where idusuario=? order by id desc limit 1', $idusu);
        $id = 0;
        foreach ($res as $row) {
            $id = $row['id'];
        }
        return $id;
    }

    public function selectutodosId($idusu) {
        $res = $this->selectBase('id', 'where idusuario=? order by id', $idusu);
        $id = array();
        foreach ($res as $row) {
            $id[] = $row['id'];
        }
        return $id;
    }


    public function modoTriando($idp, $st = NULL) {
        $id = -10;
        if ($st == NULL) {
            $res = $this->selectBase('status', 'where id=?', $idp);
            foreach ($res as $row) {
                $id = $row['status'];
            }
        }

        if ($id != -10) {
            $id = ($id + 1) * (-1);
            $this->updateBase(array($id, $idp), 'status', 'where id=?');
        } else {
            $this->updateBase(array($st, $idp), 'status', 'where id=?');
        }
    }

}
