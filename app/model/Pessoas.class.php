<?php

final class Pessoas {

    private $id;
    private $data;
    private $idusuario;
    private $tipo;
    private $nome;
    private $nascimento;
    private $cpf;
    private $rg;
    private $orgao;
    private $celular;
    private $fixo;
    private $status;
    private $segmento;
    private $anexo;
    private $declaracao;
    private $texto;

    function __construct($id, $data, $idusuario, $tipo, $nome, $nascimento, $cpf, $rg, $orgao, $celular, $fixo, $status, $segmento, $anexo, $declaracao, $texto) {
        $this->id = $id;
        $this->data = $data;
        $this->idusuario = $idusuario;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->orgao = $orgao;
        $this->celular = $celular;
        $this->fixo = $fixo;
        $this->status = $status;
        $this->segmento = $segmento;
        $this->anexo = $anexo;
        $this->declaracao = $declaracao;
        $this->texto = $texto;
    }

    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getNome() {
        return $this->nome;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getNascimentoBrasil() {
        return substr($this->nascimento, 8) . '/' . substr($this->nascimento, 5, 2) . '/' . substr($this->nascimento, 0, 4);
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getOrgao() {
        return $this->orgao;
    }

    function getCelular() {
        return $this->celular;
    }

    function getFixo() {
        return $this->fixo;
    }

    function getStatus() {
        return $this->status;
    }

    function getSegmento() {
        return $this->segmento;
    }

    function getAnexo() {
        return $this->anexo;
    }

    function getDeclaracao() {
        return $this->declaracao;
    }

    function getDeclaracaoVerificar($id) {
        $v = FALSE;
        foreach ($this->declaracao as $value) {
            if ($value->getTipo() == $id) {
                $v = TRUE;
            }
        }
        return $v;
    }

    function getTexto() {
        return $this->texto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setOrgao($orgao) {
        $this->orgao = $orgao;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setFixo($fixo) {
        $this->fixo = $fixo;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setSegmento($segmento) {
        $this->segmento = $segmento;
    }

    function setAnexo($anexo) {
        $this->anexo = $anexo;
    }

    function setDeclaracao($declaracao) {
        $this->declaracao = $declaracao;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function toHtml() {
        $tpm='<h2>Secretaria da Cultura do Estado do Rio de Janeiro</h2><br><br>';
        if ($this->getTipo() == '0') {
            $tpm.= "<label class='ver'>ELEITOR</label>";
        } else {
            $tpm.= "<br><label class='ver'>CANDIDATO</label>";
        }
        $tpm.= "<br><label class='ver'>Nome: {$this->getNome()}</label>";
        $tpm.= "<br><label class='ver'>Nascimento: {$this->getNascimentoBrasil()}</label>";
        $tpm.= "<br><label class='ver'>CPF: {$this->getCpf()}</label>";
        $tpm.= "<br><label class='ver'>RG: {$this->getRg()}</label>";
        $tpm.= "<br><label class='ver'>&Oacute;rg&atilde;o Expedidor: {$this->getOrgao()}</label>";
        $tpm.= "<br><label class='ver'>Telefone: {$this->getFixo()}</label>";
        $tpm.= "<br><label class='ver'>Celular: {$this->getCelular()}</label>";
        $tpm.= "<br><label class='ver'>Segmento: {$this->getSegmento()->getNome()}</label>";
        $tpm.= '<p class="p1">DECLARAÇÕES:</p>';
        foreach ($this->getDeclaracao() as $value) {
            $tpm.= "<br><label class='ver'>{$value->getNome()}</label>";
        }
        $tpm.= "<br><br><label class='caixatexto'>CURRÍCULO RESUMIDO DE ATUAÇÃO NO SEGMENTO CULTURAL:<br> {$this->getTexto()->getCurriculo()}</label>";
        if ($this->getTipo() == '1') {
            $tpm.= "<br><br><label class='caixatexto'>PROPOSTA DE ATUAÇÃO NO CONSELHO ESTADUAL DE POLITICA CULTURAL:<br> {$this->getTexto()->getProposta()}</label>";
            $tpm.= "<br><br><label class='caixatexto'>JUSTIFICATIVA DA SUA CANDIDATURA: (3 mil caracteres) <br>{$this->getTexto()->getJustificativa()}</label>";
        }
        foreach ($this->getAnexo() as $value) {
            if ($value->getTipo() == 'foto') {
                $tpm.= "<br><br><label class='caixatexto'>FOTOGRAFIA DE ROSTO ATUAL:</label>";
                $tpm.= "<br>{URLDOM}/cepc/{$value->getNome()}";
            } else {
                $tpm.= "<br><br><label class='caixatexto'>DOCUMENTAÇÃO COMPLEMENTAR:<br>{URLDOM}/cepc/{$value->getNome()}";
                
            }
        }
        $tpm.='<br><br>Rua da Quitanda, 86 - 8&#176; andar'
                . '<br>Centro - Rio de Janeiro - CEP: 20091-005'
                . '<br>Tel.: (21) 2216-8500'
                . '<br>Fax: (21) 2216-8501'
                . '<br>cultura@cultura.rj.gov.br';
        return $tpm;
    }

}
?>