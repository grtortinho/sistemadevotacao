<?php

final class Geral {

    function __construct($dados) {
        
        $class = 'index';
        $metodo = 'mIndex';
        if (count($dados) > 0) {
            $class = $dados[0];
            if (count($dados) > 1) {
                $metodo = $dados[1];
            }
        }
        $fim = new $class();
        $fim->$metodo($dados);
    }

}
