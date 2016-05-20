<?php

final class Upload {

    public function Up($name, $inicio = '', $extensoes = array('jpg', 'png', 'gif'), $tamanho = 12) {
// Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = 'arq/';
// Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * $tamanho; // 12Mb
// Array com as extensões permitidas
        $_UP['extensoes'] = $extensoes;
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = TRUE;
// Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES[$name]['error'] != 0) {
            return "Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES[$name]['error']];
        }
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
        $ext=explode('.', $_FILES[$name]['name']);
        $extensao = strtolower(end($ext));
        if ($extensoes != NULL) {
            
            if (array_search($extensao, $_UP['extensoes']) === false) {
                $ta=  count($extensoes);
                $tema=array();
                for($i=0;$i<$ta-1;$i++){
                    $tema[]=$extensoes[$i];
                }
                $tema=  implode(',', $tema).' ou '.$extensoes[$ta-1];
                return "Por favor, envie arquivos com as seguintes extensões: ".$tema;
            }
        }
// Faz a verificação do tamanho do arquivo
        if ($_UP['tamanho'] <= $_FILES[$name]['size']) {
            return "O arquivo enviado é muito grande, envie arquivos de até {$tamanho}Mb.";
        }
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
// Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = $inicio.md5(time()) .'.'.$extensao;
        } else {
// Mantém o nome original do arquivo
            $nome_final = $_FILES[$name]['name'];
        }

// Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            return $_UP['pasta'] . $nome_final ;
        } else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
            return FALSE;
        }
    }

}
