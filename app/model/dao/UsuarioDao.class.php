<?php

final class UsuarioDao extends Base {

    public function __construct() {
        parent::__construct("usuario");
        $this->conectar();
    }

    public function alterarSenha($login, $senha) {
        $this->updateBase(array($senha, $login), 'senha', 'where login=?');
    }


    public function alterar($id,$login, $status) {
        $this->updateBase(array($login,$status,$id), array('login','status'), 'where id=?');
    }

    public function inserir($login, $senha, $status) {
        $this->insertBase(array('null', $login, $senha, $status));
    }

    public function select($login, $senha) {
        $res = $this->selectBase('*', 'where login=? and senha=?', array($login, $senha));
        $usu = NULL;
        foreach ($res as $row) {
            $usu[] = new Usuario(
                    $row['id'], $row['login'], $row['status']);
        }

        return $usu;
    }

    public function selectPorTipo($tipo) {
        $res = $this->selectBase("*", 'where status=?', $tipo);
        $usu = array();
        foreach ($res as $row) {
            $usu[] = new Usuario(
                    $row['id'], $row['login'], $row['status']);
        }

        return $usu;
    }

    public function selectPorId($id) {
        $res = $this->selectBase("*", 'where id=?', $id);
        $usu = null;
        foreach ($res as $row) {
            $usu = new Usuario(
                    $row['id'], $row['login'], $row['status']);
        }

        return $usu;
    }

    public function quantidadePorTipo($tipo) {
        $res = $this->selectBase("COUNT(*) as q", 'where status=?', $tipo);
        $q = 0;
        foreach ($res as $row) {
            $q = $row['q'];
        }
        return $q;
    }

    public function ValidarEmail($email) {
        $res = $this->selectBase("*", 'where login=?', $email);
        foreach ($res as $row) {
            if ($row['login'] == $email) {
                $email = $row['id'];
            } else {
                $email = 0;
            }
        }
        return $email;
    }

    public function emailPorId($id) {
        $res = $this->selectBase("login", 'where id=?', $id);
        $email = '';
        foreach ($res as $row) {
                $email = $row['login'];
        }
        return $email;
    }

    public function idPorTipo($tipo) {
        $res = $this->selectBase("*", 'where status=? ', $tipo);
        $id = array();
        foreach ($res as $row) {
            $id[] = $row['id'];
        }
        return $id;
    }

    public function idPorTipoQan($tipo, $inicio, $quantidade) {
        $res = $this->selectBase("*", "where status=? limit {$inicio},{$quantidade}", $tipo);
        $id = array();
        foreach ($res as $row) {
            $id[] = $row['id'];
        }
        return $id;
    }

    public function desativar($idp) {
        
            $this->updateBase(array('0', $idp), 'status', 'where id=?');
        
    }

    public function ativar($idp,$status) {
        
            $this->updateBase(array($status, $idp), 'status', 'where id=?');
        
    }
    
    


}
