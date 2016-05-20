<?php

final class Index {

    function mIndex($dadoscepc) {
        $usuario = new UsuarioLogin();
        if ($usuario->verificar(TRUE) && (int) $usuario->getStatus() > 0) {
            new Exibir("index", $dadoscepc);
        }elseif (!$usuario->verificar(TRUE)) {
            new Exibir("index", $dadoscepc);
        }
    }

    function listafinal($dadoscepc) {
        $u = new UsuarioLogin();
        if ($u->verificar()) {
            $seg = new SegmentoDao();
            $segmentos = $seg->selectTodos();
            $dados = array();
            foreach ($segmentos as $value) {
                $dados[$value->getId()] = array($value->getNome(), 0, 0,array(),array());
            }

            $usuari = new UsuarioDao();
            $u = $usuari->selectPorTipo(1);
            $pes = new PessoaDao();
            $p = $pes->selectIdmenor();

            foreach ($u as $value) {
                $tep = NULL;
                foreach ($p as $value2) {
                    if ($value->getId() == $value2->getIdusuario()) {
                        $tep = $value2;
                    }
                }
                $i = $tep->getTipo() + 1;
                $j=$i+2;
                $dados[$tep->getSegmento()][$i]+=1;
                $dados[$tep->getSegmento()][$j][]=array($tep,$value->getLogin());

            }
            $ex = array();
            $ex[] = array('Segmento', 'Eleitores', 'Candidatos');
            foreach ($dados as $value) {
                $ex[] = array($value[0], $value[1], $value[2]);
            }
            
            echo '<h1>Estat&iacute;stica</h1><br><table>';
            foreach ($ex as $value) {
                echo '<tr>';
                foreach ($value as $value2) {
                    echo '<td>';
                    echo $value2;
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';

            echo '<a href=URLDOM."/cepc/index2.php?url=index/listafinal2&a=a">Baixar</a>';

            echo '<h1>Estat&iacute;stica</h1><br>';
            echo '<a href=URLDOM."/cepc/index2.php?url=index/listafinal3&a=a">Baixar lista de Candidatos e Eleitores com E-mail e Nome</a>';


         
        }
    }

    function listafinal3($dadoscepc) {
        $u = new UsuarioLogin();
        if (!$u->verificar()) {
            $seg = new SegmentoDao();
            $segmentos = $seg->selectTodos();
            $dados = array();
            foreach ($segmentos as $value) {
                $dados[$value->getId()] = array($value->getNome(), 0, 0,array(),array());
            }

            $usuari = new UsuarioDao();
            $u = $usuari->selectPorTipo(1);
            $pes = new PessoaDao();
            $p = $pes->selectIdmenor2();

            foreach ($u as $value) {
                $tep = NULL;
                foreach ($p as $value2) {
                    if ($value->getId() == $value2->getIdusuario()) {
                        $tep = $value2;
                    }
                }
                $i = $tep->getTipo() + 1;
                $j=$i+2;
                $dados[$tep->getSegmento()->getId()][$i]+=1;
                $dados[$tep->getSegmento()->getId()][$j][]=array($tep,$value->getLogin());

            }
            $ex2 = array();
            foreach ($dados as $value) {
                $ex2[] = array($value[0],'','');
                $ex2[] = array('Id','Eleitores','E-mail','Nascimento','CPF','RG','Órgão','Telefone','Celular','Segmento','Status','Voto','CURRÍCULO','PROPOSTA','JUSTIFICATIVA');
                foreach ($value[3] as $value2) {
                    $ex2[] = array(
                        $value2[0]->getIdusuario()
                        ,$value2[0]->getNome()
                        ,$value2[1]
                        ,$value2[0]->getNascimentoBrasil()
                        ,$value2[0]->getCpf()
                        ,$value2[0]->getRg()
                        ,$value2[0]->getOrgao()
                        ,$value2[0]->getFixo()
                        ,$value2[0]->getCelular()
                        ,$value2[0]->getSegmento()->getNome()
                        ,($value2[0]->getStatus() > 2) ? 'Aprovado':'Reprovado'
                        ,($value2[0]->getStatus() > 4) ? 'Sim':'Não'
                        ,$value2[0]->getTexto()->getCurriculo()
                        ,$value2[0]->getTexto()->getProposta()
                        ,$value2[0]->getTexto()->getJustificativa()
                        );
                }
                $ex2[] = array('','','');
                $ex2[] = array('Id','Eleitores','E-mail','Nascimento','CPF','RG','Órgão','Telefone','Celular','Segmento','Status','Voto','CURRÍCULO','PROPOSTA','JUSTIFICATIVA');
                foreach ($value[4] as $value2) {
                    $ex2[] = array(
                        $value2[0]->getIdusuario()
                        ,$value2[0]->getNome()
                        ,$value2[1]
                        ,$value2[0]->getNascimentoBrasil()
                        ,$value2[0]->getCpf()
                        ,$value2[0]->getRg()
                        ,$value2[0]->getOrgao()
                        ,$value2[0]->getFixo()
                        ,$value2[0]->getCelular()
                        ,$value2[0]->getSegmento()->getNome()
                        ,($value2[0]->getStatus() > 2) ? 'Aprovado':'Reprovado'
                        ,($value2[0]->getStatus() > 4) ? 'Sim':'Não'
                        ,$value2[0]->getTexto()->getCurriculo()
                        ,$value2[0]->getTexto()->getProposta()
                        ,$value2[0]->getTexto()->getJustificativa()
                        );
                }
                $ex2[] = array('','','');
            }
            $csv = new CSV('Estatística CEPC');
            $csv->addDados($ex2);
            $csv->gerar();
        }
    }
    function listafinal2($dadoscepc) {
        $u = new UsuarioLogin();
        if (!$u->verificar()) {
            $seg = new SegmentoDao();
            $segmentos = $seg->selectTodos();
            $dados = array();
            foreach ($segmentos as $value) {
                $dados[$value->getId()] = array($value->getNome(), 0, 0);
            }

            $usuari = new UsuarioDao();
            $u = $usuari->selectPorTipo(1);
            $pes = new PessoaDao();
            $p = $pes->selectIdmenor();

            foreach ($u as $value) {
                $tep = NULL;
                foreach ($p as $value2) {
                    if ($value->getId() == $value2->getIdusuario()) {
                        $tep = $value2;
                    }
                }
                $i = $tep->getTipo() + 1;
                $dados[$tep->getSegmento()][$i]+=1;
            }
            $ex = array();
            $ex[] = array('Segmento', 'Eleitores', 'Candidatos');
            foreach ($dados as $value) {
                $ex[] = array($value[0], $value[1], $value[2]);
            }

            $csv = new CSV('Estatística CEPC');
            $csv->addDados($ex);
            $csv->gerar();
//            new Exibir("redirecao", URLDOM."index.php?url=index/listafinal");
        }
    }

    function lista($dadoscepc) {
        $seg = new SegmentoDao();
        $segmentos = $seg->selectTodos();
        $dadoscepc[3] = $segmentos;
        new Exibir("listadesegmento", $dadoscepc);
    }

    function votacaofinal($dadoscepc) {
        $usuario = new UsuarioLogin(); 
        $data = new DataSistema();
        if ($data->validar('final') or $usuario->getStatus() == 3) {
            $votodao = new VotoDao();
            $voto = $votodao->select();
            $segmentodao = new SegmentoDao();
            $segmento = $segmentodao->selectTodos();
            $dados = array();
            $dadostotal = array();
            foreach ($segmento as $value) {
                $dados[$value->getNome()] = array();
                $dadostotal[$value->getNome()] = 0;
            }
            foreach ($voto as $value) {
                $dados[$value->getSegmento()][] = array($value, $value->getVoto());
                $dadostotal[$value->getSegmento()]+=(int) $value->getVoto();
            }

            $dadoscepc[2] = $dados;
            $dadoscepc[3] = $dadostotal;
            $dadoscepc[4] = $usuario->getStatus();
            new Exibir("votacaofinal", $dadoscepc);
        }
    }

    function votacao($dadoscepc) {
        $u = new UsuarioLogin();
        if ($u->verificar()) {
            $data = new DataSistema();
            if ($data->validar('voto')) {
                $pessoa = new PessoaDao;
                $pes = $pessoa->selectId($u->getId());
                $ses = new DadosSesao();
                $valo = array();
                if (!empty($ses->verDado('idsv'))) {
                    $valo = $ses->verDado('idsv');
                }
                if (array_key_exists(2, $dadoscepc)) {
                    if (array_key_exists($dadoscepc[2], $valo)) {
                        $id = $valo[$dadoscepc[2]];
                        $dadoscepc[3] = $pessoa->selectIdPessoa($id);
                        $dadoscepc[4] = $dadoscepc[2];
                        $dadoscepc[5] = $pes->getSegmento()->getNome();
                        new Exibir("verlistacandidato2", $dadoscepc);
                        //$vo = new VotoDao();
                        //$vo->addVolto($id);
                    } else {
                        new Erro('no sistema');
                    }
                } else {
                    new Erro('no sistema');
                }
            }
        }
    }

    function votacao2($dadoscepc) {
        $ses = new DadosSesao();
        $valo = array();
        if (!empty($ses->verDado('idsv'))) {
            $valo = $ses->verDado('idsv');
        }
        $ses->apagarDado('idsv');
        if (array_key_exists(2, $dadoscepc)) {
            if (array_key_exists($dadoscepc[2], $valo)) {
                $id = $valo[$dadoscepc[2]];
                $vo = new VotoDao();
                $vo->addVolto($id);
                new Exibir('alert', 'Votação realizada com sucesso');
                new Exibir("redirecao", URLDOM."index.php");
            } else {
                new Erro('no sistema');
            }
        } else {
            new Erro('no sistema');
        }
    }

    function listafim($dadoscepc) {
        $u = new UsuarioLogin();
        if ($u->verificar()) {
            $data = new DataSistema();
            if ($data->validar('voto')) {
                $pessoa = new PessoaDao;
                $pes = $pessoa->selectId($u->getId());
                $seg = $pes->getSegmento()->getId();
                $q = (int) $pessoa->quantidadePorSegmento($seg);
                $total = 45;
                $paginas = ceil($q / $total);
                $paginaatual = 1;
                if (isset($dadoscepc[3])) {
                    $paginaatual = (int) $dadoscepc[3];
                }
                $ini = ($paginaatual - 1) * $total;
                $resul = $pessoa->selectSegmentoCandidato($seg, $ini, $total);
                $ids = array();
                $idp = array();
                $ses = new DadosSesao();
                $ses->apagarDado('idsv');
                $hora = new DateTime();
                foreach ($resul as $value) {
                    $tp = $u->getId() . '-' . $hora->getTimestamp() . '-' . $value->getId();
                    $tp = md5($tp);
                    $ids[$tp] = $value->getId();
                    $idp[$value->getId()] = $tp;
                }
                $ses->criarDado('idsv', $ids);
                $pagination = new Paginacao($paginas, 10, $paginaatual, URLDOM.'index.php?url=index/listafim/' . $seg . '/', 'pagination');
                $dadoscepc[3] = $resul;
                $dadoscepc[4] = $pagination->exibir();
                $dadoscepc[5] = $idp;
                $dadoscepc[6] = $pes->getSegmento()->getNome();
                $dadoscepc[7] = URLDOM;
                new Exibir("verlistacandidato", $dadoscepc);
            }
        }
    }

    function menu($dadoscepc) {
        $usuario = new UsuarioLogin();
        $dataSitema = new DataSistema();
        if ($usuario->verificar(TRUE) && (int) $usuario->getStatus() > 0) {
            $dadoscepc[3][] = '<li role="presentation"  class="active"><a href="/">HOME</a></li>';
        }elseif (!$usuario->verificar(TRUE)) {
            $dadoscepc[3][] = '<li role="presentation"  class="active"><a href="/">HOME</a></li>';
        }
        if ((!$usuario->verificar(TRUE) and $dataSitema->validar('final')) or ($usuario->verificar(TRUE) and $usuario->getStatus() == 3)) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=index/votacaofinal">Resultado Final</a></li>';
            }
        if (!$usuario->verificar(TRUE)) {
            if ($dataSitema->validar('cadastro')) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=cadastro">Cadastro</a></li>';
            }
            if ($dataSitema->validar('resultado')) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=triage/resultado">Resultado da Triagem</a></li>';
            }
            $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=login">Login</a></li>';
            $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=login/esqueciasenha">Esqueci a senha</a></li>';
        } else {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=login/logof">Logoff</a></li>';
            if ((int) $usuario->getStatus() > 0) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=login/alterarsenha">Alterar senha</a></li>';
            }
            if ((int) $usuario->getStatus() == 1) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=index/ver">Ver dados</a></li>';
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=cadastro/alterar">Alterar dados</a></li>';
                if ($dataSitema->validar('voto')) {
                    $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=index/listafim" style="color:#f00">Votação</a></li>';
                }
            }
            if ((int) $usuario->getStatus() >= 2) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=triage">Triar</a></li>';
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=triage/retriagem">Retriar</a></li>';
            }
            if ((int) $usuario->getStatus() == 3) {
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=cadastro/listadesegmento">Lista de Segmento</a></li>';
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=cadastro/listatriagista">Lista de Usuario</a></li>';
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=triage/resultado">Resultado da Triagem</a></li>';
                $dadoscepc[3][] = '<li role="presentation"><a class="pointer_6" href="index.php?url=index/listafinal">Estat&iacute;stica</a></li>';
            }
        }
        new Exibir("menu", $dadoscepc);
    }

    function ver($dado) {
        $u = new UsuarioLogin;
        if ($u->verificar() && $u->getStatus() == 1) {
            $p = new PessoaDao();
            $pe = $p->selectId($u->getId());

            $dado[3] = $pe;
            $dado[4] = $u->getLogin();
            new Exibir('ver', $dado);
        } else {
            new Exibir("login", $dado);
        }
    }

}
