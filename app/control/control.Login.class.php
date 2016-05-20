<?php

final class Login {

    function mIndex($dado) {
        $u = new UsuarioLogin();
        if ($u->verificar()) {
            new Exibir("redirecao", URLDOM."index.php");
        } else {

            new Exibir("login", $dado);
        }
    }

    function logof($dado) {
        $u = new UsuarioLogin();
        $u->logof();
        new Exibir("redirecao", URLDOM."index.php");
    }

    function esqueciasenha($dado) {
        new Exibir("senha", $dado);
    }

    function alterarsenha($dado) {
        $usuario = new UsuarioLogin();
        if ((int) $usuario->getStatus() > 0) {
            new Exibir("alterarsenha", $dado);
        }
    }

    function alterarsenhafinal($dado) {
        $u = new UsuarioLogin();
        $f = new FormulariosPega();
        if ($u->verificar() and $f->verificarPost('atual') and $f->verificarPost('nova') and $f->verificarPost('rnova')) {
            if($f->post('nova')==$f->post('rnova')){
                $us = new UsuarioDao();
                $usu = $us->select($u->getLogin(), sha1($f->post('atual')));
                if (gettype($usu) == "array" and count($usu) == 1) {
                    $em2 = sha1($f->post('nova'));
                    $us->alterarSenha($u->getLogin(), $em2);
                    $this->logof();
                }else{
                   $this->alterarsenha();
                }
            }else{
                $this->alterarsenha();
            }
        }else{
            $this->alterarsenha();
        }
    }

    function alterarsenhainicial($dado) {
        $u = new UsuarioLogin();
        $f = new FormulariosPega();
        if ($u->verificar(true) and $f->verificarPost('nova') and $f->verificarPost('rnova')) {
            if($f->post('nova')==$f->post('rnova')){
                $us = new UsuarioDao();
                $em2 = sha1($f->post('nova'));
                $us->alterarSenha($u->getLogin(), $em2);
                $status=((int) $u->getStatus())* -1;
                $us->ativar($u->getId(),$status);
                $usu = $us->select($u->getLogin(), $em2);
                $u->logof();
                if (gettype($usu) == "array" and count($usu) == 1) {
                    $u->login((int) $usu[0]->getId(), $usu[0]->getLogin(), '', $usu[0]->getStatus());
                    new Exibir("redirecao", URLDOM."index.php");
                }
            }else{
                new Exibir("alterarsenhainicial", null);
                die();
            }
        }else{
            new Exibir("alterarsenhainicial", null);
                die();
        }
    }

    function senha($dado) {
        $u = new UsuarioDao();
        $f = new FormulariosPega();
        $l = $f->post('login');
        if ($u->ValidarEmail($l)!=0) {
            $s = new GerarSenha();
            $em = $s->geraSenha(6);
            $em2 = sha1($em);
            $u->alterarSenha($l, $em2);
            $email = new Email();
            $email->mansangem($l, 'Senha', "Sua senha é: " . $em.','.$em2);
            new Exibir("login", $dado);
        }
    }

    function mlogin($dado) {
        $u = new UsuarioLogin();
        $f = new FormulariosPega();
        if (!$u->verificar() and $f->verificarPost('login') and $f->verificarPost('senha')) {
            $l = $f->post('login');
            $s = sha1($f->post('senha'));
            $us = new UsuarioDao();
            $usu = $us->select($l, $s);
            if (gettype($usu) == "array" and count($usu) == 1) {
                if ((int) $usu[0]->getStatus() != 0) {
                    $u->login((int) $usu[0]->getId(), $usu[0]->getLogin(), '', $usu[0]->getStatus());
                    new Exibir("redirecao", URLDOM."index.php?url=login");
                } else {
                    new Exibir("redirecao", URLDOM."index.php?url=login");
                }
            } else {

                new Exibir("redirecao", URLDOM."index.php?url=login");
            }
        } else {
            new Exibir("redirecao", URLDOM."index.php?url=login");
        }
    }

}
