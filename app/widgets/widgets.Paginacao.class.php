<?php

final class Paginacao {

    private $quantidade;
    private $maximo;
    private $atual;
    private $urlInicial;
    private $id;
    private $class;

    function __construct($quantidade, $maximo, $atual, $urlInicial, $class = NULL, $id = null ) {
        $this->quantidade = $quantidade;
        $this->atual = $atual;
        $this->urlInicial = $urlInicial;
        $this->id = $id;
        $this->class = $class;
        if ($maximo > 4) {
            $this->maximo = $maximo;
        } else {
            $this->maximo = 4;
        }
        if ($maximo>$quantidade){
            $this->maximo=$quantidade;
        }
    }

    function exibir() {

        $ul = "<ul";
        if (!empty($this->class)) {
            $ul.=" class='{$this->class}'";
        }
        if (!empty($this->id)) {
            $ul.=" id='{$this->id}'";
        }
        $dados="<li><a href='" . $this->urlInicial;
        $valini = array();
        $valfim = array();
        $i = 0;
        if ($this->atual > 2) {
            $i++;
            $valini[] = $dados . "1'><<</a></li>";
        }
        if ($this->atual > 1) {
            $i++;
            $t = $this->atual - 1;
            $valini[] = $dados . "{$t}'><</a></li>";
        }
        if ($this->atual < $this->quantidade) {
            $i++;
            $t = $this->atual + 1;
            $valfim[] = $dados . "{$t}'>></a></li>";
        }
        if ($this->atual + 1 < $this->quantidade) {
            $i++;
            $valfim[] = $dados . "{$this->quantidade}'>>></a></li>";
        }
        $ma = $this->maximo - $i;
        $i = 0;
        if ($ma % 2 == 0) {
            $i = $this->atual - ($ma / 2) + 1;
        } else {
            $i = $this->atual - (($ma - 1) / 2);
        }
        if ($i<1){
            $i=1;
        }
        $fim=$i + $ma - 1;
        if($fim>$this->quantidade){
            $fim=  $this->quantidade;
        }
        for ($index = $i; $index <= $fim; $index++) {
            if ($index != $this->atual) {
                $valini[] = $dados . "{$index}'>{$index}</a></li>";
            } else {
                $valini[] = "<li class='active'><a href='" . $this->urlInicial."{$index}'>{$index}</a></li>";
            }
        }
        return $ul.">".implode("", $valini).implode("", $valfim)."</ul>";
    }

}
?>

