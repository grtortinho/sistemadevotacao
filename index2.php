<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
if (isset($_GET['a']) and $_GET['a']=='a') {
    define("URLDOM", "http://cepc/");

    session_start();
    function __autoload($classe) {
        $classe = ucfirst($classe);
        if (file_exists("app/ado/ado.{$classe}.class.php")) {
            include_once "app/ado/ado.{$classe}.class.php";
        } elseif (file_exists("app/control/control.{$classe}.class.php")) {
            include_once "app/control/control.{$classe}.class.php";
        } elseif (file_exists("app/model/{$classe}.class.php")) {
            include_once "app/model/{$classe}.class.php";
        } elseif (file_exists("app/model/dao/{$classe}.class.php")) {
            include_once "app/model/dao/{$classe}.class.php";
        } elseif (file_exists("app/widgets/widgets.{$classe}.class.php")) {
            include_once "app/widgets/widgets.{$classe}.class.php";
        } else {

            echo "Class {$classe} não exite";
        }
    }

}else{
}

$amiga = "";
if (isset($_GET['url']) and $_GET['url'] != '') {
    $amiga = $_GET['url'];
}
$url = explode("/", $amiga);
$url = array_filter($url);
new Geral($url);

