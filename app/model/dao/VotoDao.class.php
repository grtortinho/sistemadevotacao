<?php

final class VotoDao extends Base {

    public function __construct() {
        parent::__construct("voto");
        $this->conectar();
    }

    public function insert($id,$nome,$segmento) {
        $this->insertBase(array($id, 0,$nome,$segmento));
    }

    public function addVolto($id) {
        $u = new UsuarioLogin();
        if ($u->verificar()) {
            $data = new DataSistema();
            if ($data->validar('voto')) {


                $p = new PessoaDao();
                $pessoa = $p->selectId($u->getId());
                if ($pessoa->getStatus() == 3 or $pessoa->getStatus() == 4) {
                    parent::__construct("voto", TRUE);
                    $this->setPdo($this->conectar());
                    $this->iniciarTransacoes();
                    $this->updateBase($id, array(), ' voto=voto+1 where id=?');
                    parent::__construct("pessoa", TRUE);
                    $this->updateBase($pessoa->getId(), array(), ' status=status+2 where id=?');
                    $this->finalizarTransacoes();
                } else {
                    if ($pessoa->getStatus() < 3) {
                        new Erro('Você não tem permissão para votar');
                    } elseif ($pessoa->getStatus() > 4) {
                        new Erro('Você já votou');
                    }
                }
            } else {
                new Erro('Data da votação expirada');
            }
        } else {
            new Erro('Você não está logado');
        }
    }

    public function select() {
        $res = $this->selectBase("*",' order by voto desc ');
        $voto = array();
        foreach ($res as $row) {
            $voto[] = new Voto($row['id'], $row['voto'], $row['nome'], $row['segmento']);
        }
        return $voto;
    }

}
