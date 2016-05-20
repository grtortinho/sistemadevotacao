<?php

final class Texto {

    private $id;
    private $curriculo;
    private $proposta;
    private $justificativa;

    function __construct($id, $curriculo, $proposta, $justificativa) {
        $this->id = $id;
        $this->curriculo = $curriculo;
        $this->proposta = $proposta;
        $this->justificativa = $justificativa;
    }

    function getId() {
        return $this->id;
    }

    function getCurriculo() {
        return $this->curriculo;
    }

    function getProposta() {
        return $this->proposta;
    }

    function getJustificativa() {
        return $this->justificativa;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCurriculo($curriculo) {
        $this->curriculo = $curriculo;
    }

    function setProposta($proposta) {
        $this->proposta = $proposta;
    }

    function setJustificativa($justificativa) {
        $this->justificativa = $justificativa;
    }

}
