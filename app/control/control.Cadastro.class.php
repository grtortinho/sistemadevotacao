<?php

final class Cadastro {

    function mIndex($dadoscepc) {
        $usuario = new UsuarioLogin();
        if (!$usuario->verificar()) {
            $segmento = new SegmentoDao();
            $declaracoes = new declaracoesDao();
            $dadoscepc[3] = $segmento->selectTodos();
            $dadoscepc[4] = $declaracoes->selectTodos();
            new Exibir("cadastro", $dadoscepc);
        }
    }

    function triagista($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            new Exibir("cadastrotriagista", $dadoscepc);
        }
    }

    function segmento($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            new Exibir("cadastrosegmento", $dadoscepc);
        }
    }

    function listatriagista($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new TriagistaDao();
            $dadoscepc[3] = $t->selectTodosSemLogardo($usuario->getId());
            new Exibir("vertriagista", $dadoscepc);
        }
    }

    function listadesegmento($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new SegmentoDao();
            $dadoscepc[3] = $t->selectTodos();
            new Exibir("versegmento", $dadoscepc);
        }
    }

    function triagistaalterar($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new TriagistaDao();
            $dadoscepc[3] = $t->selectPorId($dadoscepc[2]);
            new Exibir("cadastrotriagistaalterar", $dadoscepc);
        }
    }

    function segmentoalterar($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new SegmentoDao();
            $dadoscepc[3] = $t->selectPorId($dadoscepc[2]);
            new Exibir("cadastrosegmentoalterar", $dadoscepc);
        }
    }

    function triagistaalterarfim($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new TriagistaDao();
            $formulario = new FormulariosPega();
            $login = $formulario->post("login");
            $tipo = $formulario->post("tipo");
            $nome = $formulario->post("nome");
            $t->alterar($dadoscepc[2],$nome,$login,$tipo);
            $dadoscepc[3] = $t->selectTodosSemLogardo($usuario->getId());
            new Exibir("vertriagista", $dadoscepc);
        }
    }

    function segmentoalterarfim($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $t = new SegmentoDao();
            $formulario = new FormulariosPega();
            $nome = $formulario->post("nome");
            $t->alterar($dadoscepc[2],$nome);
            new Exibir("redirecao", URLDOM."index.php?url=cadastro/listadesegmento");
        }
    }

    function alterar($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 1) {
            $segmento = new SegmentoDao();
            $declaracoes = new declaracoesDao();
            $pessoa = new PessoaDao();
            $dadoscepc[3] = $segmento->selectTodos();
            $dadoscepc[4] = $declaracoes->selectTodos();
            $pes = $pessoa->selectId($usuario->getId());
            if ($pes->getStatus() == 0) {


                $dadoscepc[5] = $pessoa->selectId($usuario->getId());
                new Exibir("alterarcadastro", $dadoscepc);
            } else {
                new Erro("Você ja foi triado.");
            }
        } else {
            new Exibir("redirecao", URLDOM."index.php?url=login");
        }
    }

    function triagistafim($dado) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $formulario = new FormulariosPega();
            $login = $formulario->post("login");
            $senha = $formulario->post("senha");
            $csenha = $formulario->post("csenha");
            $tipo = '-'.$formulario->post("tipo");
            $nome = $formulario->post("nome");
            if ($senha == $csenha) {
                $u = new UsuarioDao();
                if ($u->ValidarEmail($login) == 0) {
                    $u->inserir($login, sha1($senha), $tipo);
                    $id = $u->ValidarEmail($login);
                    $t = new TriagistaDao();
                    $t->insert($id, $nome);
                    new Exibir("cadastrotriagista", $dado);
                } else {
                    new Erro("Login ja existe");
                }
            } else {
                new Erro("Senha errada");
            }
        }
    }

    function segmentofim($dado) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar() && $usuario->getStatus() == 3) {
            $formulario = new FormulariosPega();
            $nome = $formulario->post("nome");
            $s = new SegmentoDao();
            $s->insert($nome);
            new Exibir("redirecao", URLDOM."index.php?url=cadastro/listadesegmento");
                
        }
    }

    function fim($dado) {
        $dtSis = new DataSistema();
        if ($dtSis->validar('cadastro')) {
            $formulario = new FormulariosPega();
            $tipo = $formulario->post("tipo");
            $login = $formulario->post("login");
            $senha = $formulario->post("senha");
            $csenha = $formulario->post("csenha");
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
            $up = new Upload();
            if ($senha == $csenha && !empty($senha)) {
                $u = new UsuarioDao();
                if ($u->ValidarEmail($login) == 0 && !empty($login)) {
                    $p = new PessoaDao();
                    $d = new DeclaracoesDao();
                    $do = new DeclaracaoDao();
                    $d = $d->selectTodos();
                    $a = new AnexoDao();
                    $t = new TextoDao();
                    $u->inserir($login, $senha, 1);
                    $id = $u->ValidarEmail($login);
                    $p->inserir($id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $telefone, $segmento);
                    $idp = $p->selectuId($id);
                    if (isset($_FILES['foto']['tmp_name']) && !empty($_FILES['foto']['tmp_name']) && $tipo == '1') {
                        $foto = $up->Up('foto', $idp . '-', array('jpg', 'png', 'gif'), 10);
                        if ($foto != FALSE) {
                            $a->insert($idp, $foto, 'foto');
                        }
                    }
                    if (isset($_FILES['documentacao']['tmp_name']) && !empty($_FILES['documentacao']['tmp_name'])) {
                        $doc = $up->Up('documentacao', $idp . '-', NULL, 10);
                        if ($doc != FALSE) {
                            $a->insert($idp, $doc, 'doc');
                        }
                    }
                    foreach ($d as $value) {
                        if ($formulario->verificarPost('declaracao' . $value->getId()) && $formulario->post('declaracao' . $value->getId()) == 'sim') {
                            $do->insert($idp, $value->getNome(), $value->getId());
                        }
                    }
                    $t->insert($idp, $resumido, $proposta, $justificativa);
                    $l = new Login();
                    $ids = $u->selectPorTipo(3);
                    $msn = new Email();

                    $pes = $p->selectIdPessoa($idp);
                    $texto = '<h1>Inscri&ccedil;&atilde;o realizada com sucesso</h1>';
                    $texto .= $pes->toHtml();
                    $msn->mansangem($login, $nome, $texto);
                    foreach ($ids as $value) {
                        $msn->mansangem($value->getLogin(), $nome, $texto);
                    }
                    new Exibir('alert', 'Inscrição realizada com sucesso');
                    $l = new Login();
                    $l->mlogin(null);
                } else {
                    new Erro("Login ja existe");
                }
            } else {
                new Erro("Senha errada");
            }
        } else {
            new Erro("Data expirada");
        }
    }

    function alterarfim($dado) {
        $dtSis = new DataSistema();
        if ($dtSis->validar('cadastro')) {
            $usuarioL = new UsuarioLogin();
            if ($usuarioL->verificar() && $usuarioL->getStatus() == 1) {
                $formulario = new FormulariosPega();
                $tipo = $formulario->post("tipo");
                $nome = $formulario->post("nome");
                $nascimento = $formulario->post("nascimento");
                if($nascimento == ''){
                    $nascimento='1900-01-01';
                }else{
                $nascimento=  substr($nascimento, 6).'-'.substr($nascimento, 3,2).'-'.substr($nascimento, 0,2);
                echo $nascimento;
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
                $up = new Upload();
                $u = new UsuarioDao();
                $p = new PessoaDao();
                $d = new DeclaracoesDao();
                $do = new DeclaracaoDao();
                $d = $d->selectTodos();
                $a = new AnexoDao();
                $t = new TextoDao();
                $id = $usuarioL->getId();
                $p->inserir($id, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $telefone, $segmento);
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
//                $ids = $u->selectPorTipo(3);
                $msn = new Email();
                $pes = $p->selectIdPessoa($idp);
                $texto = '<h1>Altera&ccedil;&atilde;o realizada com sucesso</h1>';
                $texto .= $pes->toHtml();
                $msn->mansangem($usuarioL->getLogin(), $nome, $texto);
//                foreach ($ids as $value) {
//                    $msn->mansangem($value->getLogin(), $nome, $texto);
//                }
                new Exibir('alert', 'Alteração realizada com sucesso');
                $l = new Login();
                $l->mlogin(null);
            } else {
                new Exibir("redirecao", URLDOM."index.php?url=login");
            }
        } else {
            new Erro("Data expirada");
        }
    }

}
