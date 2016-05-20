<?php

final class Exibir {

    function __construct($pagina, $dadoscepc = NULL) {
            include_once "app/vlew/vlew.{$pagina}.phtml";
    }
 
}
