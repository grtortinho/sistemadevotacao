<?php

 class Usuario {

    private $id;
    private $login;
    private $status;

    function __construct($id, $login, $status) {
        $this->id = $id;
        $this->login = $login;
        $this->status = $status;
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
