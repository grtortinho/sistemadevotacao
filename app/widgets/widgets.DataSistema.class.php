<?php

final class DataSistema {

    private $datas;

    function __construct() {
        $this->datas['cadastro'] = array(new DateTime('2015-10-26 11:00:00'), new DateTime('2016-02-29 23:59:59'));
        $this->datas['triage'] = array(new DateTime('2015-10-26 11:00:00'), new DateTime('2016-03-10 16:40:59'));
        $this->datas['resultado'] = array(new DateTime('2016-03-7 18:00:00'));
        $this->datas['retriagem'] = array(new DateTime('2016-03-8 00:01:00'), new DateTime('2016-03-15 18:59:59'));
        $this->datas['voto'] = array(new DateTime('2016-03-16 10:00:00'), new DateTime('2016-03-31 21:59:59'));
        $this->datas['final'] = array(new DateTime('2016-04-4 18:00:00'));
    }

    function validar($nome) {
        if (array_key_exists($nome, $this->datas)) {
            $agora = new DateTime();
            if ($this->datas[$nome][0] <= $agora) {
                if (array_key_exists(1, $this->datas[$nome])) {
                    if ($this->datas[$nome][1] >= $agora) {
                        return TRUE;
                    }  else {
                        return FALSE;
                    }
                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }
    }

}
