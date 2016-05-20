<?php

final class Triage {

    function mIndex($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 && $data->validar('triage')) {
            $u = new UsuarioDao();
            $p = new PessoaDao;
            $q = (int) $u->quantidadePorTipo(1);
            $total = 15;
            $paginas = ceil($q / $total);
            $paginaatual = 1;
            if (isset($dadoscepc[2])) {
                $paginaatual = (int) $dadoscepc[2];
            }
            $ini = ($paginaatual - 1) * $total;
            $ids = $u->idPorTipoQan(1, $ini, $total);

            $pagination = new Paginacao($paginas, 10, $paginaatual, URLDOM.'index.php?url=triage/mindex/', 'pagination');
            $pessoas = array();
            foreach ($ids as $value) {
                $pessoas[] = $p->selectId($value);
            }
            $dadoscepc[3] = $pessoas;
            $dadoscepc[4] = $pagination->exibir();
            $dadoscepc[5] = $q;
            new Exibir("verlistapessoa", $dadoscepc);
        }
    }

    function triarfim($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 && $data->validar('triage')) {
            $da = new DadosSesao();
            $id = $da->verDado('idpessoa');
            $da->apagarDado('idpessoa');
            $p = new PessoaDao();
            $pes = $p->selectIdPessoa($id);
            if ($pes->getStatus() == 0) {
                $formulario = new FormulariosPega();
                $tipo = $formulario->post("tipo");
                $justificativa = $formulario->post("justificativa");
                $tri = new TriagemDao();
                $res = new ResuldatoTriagemDao();
                if ($tipo == '0') {
                    if ($pes->getTipo() == 1) {
                        $voto = new VotoDao();
                        $voto->insert($pes->getId(),$pes->getNome(),$pes->getSegmento()->getNome());
                    }
                    $tri->insert(3, $usuario->getId(), $justificativa, $pes->getId());
                    $p->modoTriando($pes->getId(), 3);
                    $res->inserir($pes->getIdusuario(), $pes->getNome(), $pes->getSegmento()->getNome(), 3, $pes->getTipo());
                } elseif ($tipo == '1') {
                    $tri->insert(1, $usuario->getId(), $justificativa, $pes->getId());
                    $p->modoTriando($pes->getId(), 1);
                    $res->inserir($pes->getIdusuario(), $pes->getNome(), $pes->getSegmento()->getNome(), 1, $pes->getTipo());
                }
                new Exibir("redirecao", URLDOM."index.php?url=triage");
            }
        }
    }

    function retriar($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 && $data->validar('retriagem')) {
            $segmento = new SegmentoDao();
            $declaracoes = new declaracoesDao();
            $pessoa = new PessoaDao();
            $dadoscepc[3] = $segmento->selectTodos();
            $dadoscepc[4] = $declaracoes->selectTodos();
            $pes = $pessoa->selectIdPessoa((int) $dadoscepc[2]);
            $dadoscepc[5] = $pes;
            $da = new DadosSesao();
            $pessoa->modoTriando($pes->getId(),-2);
            $da->criarDado('idpessoa', (int) $dadoscepc[5]->getIdusuario());
            new Exibir("retriarcadastro", $dadoscepc);
        } else {
            new Exibir("redirecao", URLDOM."index.php?url=login");
        }
    }

    function retriarfim($dado) {
        $dtSis = new DataSistema();
        if ($dtSis->validar('retriagem')) {
            $usuarioL = new UsuarioLogin();
            if ($usuarioL->verificar() && $usuarioL->getStatus() >= 1) {
                $formulario = new FormulariosPega();
                $tipo = $formulario->post("tipo");
                $tipoa = $formulario->post("tipoa");
                $nome = $formulario->post("nome");
                $nascimento = $formulario->post("nascimento");
                            if($nascimento == ''){
                $nascimento='1900-01-01';
            }else{
                $nascimento=  substr($nascimento, 6).'-'.substr($nascimento, 3,2).'-'.substr($nascimento, 0,2);
            }
                $cpf = $formulario->post("cpf");
                $rg = $formulario->post("rg");
                $orgao = $formulario->post("orgao");
                $telefone = $formulario->post("telefone");
                $celular = $formulario->post("celular");
                $segmento = $formulario->post("segmento");
                $resumido = $formulario->post("resumido");
                $proposta = $formulario->post("proposta");
                $justificativa = $formulario->post("justificativa");
                $justificativaa = $formulario->post("justificativaa");
                $up = new Upload();
                $u = new UsuarioDao();
                $p = new PessoaDao();
                $d = new DeclaracoesDao();
                $do = new DeclaracaoDao();
                $d = $d->selectTodos();
                $a = new AnexoDao();
                $t = new TextoDao();
                $da = new DadosSesao();
                $id = $da->verDado('idpessoa');
                $da->apagarDado('idpessoa');
                $p->inserirRetriagem($id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $telefone, 1, $segmento);
                $idp = $p->selectuId($id);
                if (isset($_FILES['foto']['tmp_name']) && $tipo == '1' && !empty($_FILES['foto']['tmp_name'])) {
                    $foto = $up->Up('foto', $idp . '-', array('jpg', 'png', 'gif'), 10);
                    if ($foto != FALSE) {
                        $a->insert($idp, $foto, 'foto');
                    }
                } elseif ($tipo == '1') {
                    $foto = $formulario->post('fotoa');
                    $a->insert($idp, $foto, 'foto');
                }
                if (isset($_FILES['documentacao']['tmp_name']) && !empty($_FILES['documentacao']['tmp_name'])) {
                    $doc = $up->Up('documentacao', $idp . '-', NULL, 10);
                    if ($doc != FALSE) {
                        $a->insert($idp, $doc, 'doc');
                    }
                } elseif ($formulario->verificarPost('documentacaoa')) {
                    $doc = $formulario->post('documentacaoa');
                    $a->insert($idp, $doc, 'doc');
                }
                foreach ($d as $value) {
                    if ($formulario->verificarPost('declaracao' . $value->getId()) && $formulario->post('declaracao' . $value->getId()) == 'sim') {
                        $do->insert($idp, $value->getNome(), $value->getId());
                    }
                }
                $t->insert($idp, $resumido, $proposta, $justificativa);
                $pes = $p->selectIdPessoa($idp);
                if ($pes->getStatus() == 1) {
                    $formulario = new FormulariosPega();
                    $tri = new TriagemDao();
                    $res = new ResuldatoTriagemDao();
                    if ($tipoa == '0') {
                        if ($pes->getTipo() == 1) {
                            $voto = new VotoDao();
                            $voto->insert($pes->getId(),$pes->getNome(),$pes->getSegmento()->getNome());
                        }
                        $tri->insert(4, $id, $justificativaa, $pes->getId());
                        $p->modoTriando($pes->getId(), 4);
                        $res->update($pes->getIdusuario(), $pes->getNome(), $pes->getSegmento()->getNome(), 4, $pes->getTipo());
                    } elseif ($tipoa == '1') {
                        $tri->insert(2, $id, $justificativaa, $pes->getId());
                        $p->modoTriando($pes->getId(), 2);
                        $res->update($pes->getIdusuario(), $pes->getNome(), $pes->getSegmento()->getNome(), 2, $pes->getTipo());
                    }
                    new Exibir("redirecao", URLDOM."index.php?url=triage");
                }
            } else {
                new Exibir("redirecao", URLDOM."index.php?url=login");
            }
        } else {
            new Erro("Data expirada");
        }
    }

    function retriagem($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 && $data->validar('retriagem')) {
            $p = new PessoaDao;
            $q = (int) $p->quantidadePorTipo(1);
            $total = 15;
            $paginas = ceil($q / $total);
            $paginaatual = 1;
            if (isset($dadoscepc[2])) {
                $paginaatual = (int) $dadoscepc[2];
            }
            $ini = ($paginaatual - 1) * $total;
            $pagination = new Paginacao($paginas, 10, $paginaatual, URLDOM.'index.php?url=triage/retriagem/', 'pagination');
            $dadoscepc[3] = $p->selectStatus(1, $ini, $total);
            $dadoscepc[4] = $pagination->exibir();
            $dadoscepc[5] = $q;
            new Exibir("verlistapessoaretriagem", $dadoscepc);
        }
    }

    function resultado($dadoscepc) {
        $data = new DataSistema();
        $usuario=new UsuarioLogin();
        if ($data->validar('resultado') || $usuario->getStatus()==3) {
            $r = new ResuldatoTriagemDao();
            $res = $r->select();
            $pessoa = array(array(), array(), array(), array());
            foreach ($res as $tpm) {
                if ($tpm->getTipo() == 0) {
                    //eleitor reprovado 
                    if ($tpm->getStatus() < 3) {
                        $pessoa[0][$tpm->getSegmento()][] = $tpm;
                        //eleitor aprovado
                    } elseif ($tpm->getStatus() > 2) {
                        $pessoa[1][$tpm->getSegmento()][] = $tpm;
                    }
                } elseif ($tpm->getTipo() == 1) {
                    //candidato reprovado
                    if ($tpm->getStatus() < 3) {
                        $pessoa[2][$tpm->getSegmento()][] = $tpm;
                        //candidato aprovado
                    } elseif ($tpm->getStatus() > 2) {
                        $pessoa[3][$tpm->getSegmento()][] = $tpm;
                    }
                }
            }
            $dadoscepc[3] = $pessoa;
            new Exibir('resultado', $dadoscepc);
        }
    }


    function ver($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 ) {
            $id = $dadoscepc[2];
            $p = new PessoaDao();
            $pes = $p->selectIdPessoa($id);
            $u = new UsuarioDao();
            $email=$u->emailPorId($pes->getIdusuario());
            $dadoscepc[3] = $pes;
            $dadoscepc[4] = $email;
            new Exibir("ver", $dadoscepc);
        }
    }

    function triar($dadoscepc) {
        $usuario = new UsuarioLogin();
        $data = new DataSistema();
        if ($usuario->verificar() && $usuario->getStatus() >= 2 && $data->validar('triage')) {
            $id = $dadoscepc[2];
            $p = new PessoaDao();
            $pes = $p->selectIdPessoa($id);
            if ($pes->getStatus() == 0) {
                $da = new DadosSesao();
                $da->criarDado('idpessoa', $pes->getId());
                $u = new UsuarioDao();
                $email=$u->emailPorId($pes->getIdusuario());
                $dadoscepc[3] = $pes;
                $dadoscepc[4] = $email;
                //$p->modoTriando($id);
                new Exibir("ver", $dadoscepc);
                new Exibir('tria', $dadoscepc);
            }
        }
    }

}
