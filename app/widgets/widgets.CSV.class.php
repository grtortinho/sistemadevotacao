<?php

final class CSV {

    private $fp;

    function __construct($name) {
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename={$name}.csv;");
        header('Content-Transfer-Encoding: binary');

//open file pointer to standard output
        $this->fp = fopen('php://output', 'w');

//add BOM to fix UTF-8 in Excel
        fputs($this->fp, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    }

    public function addDados($dados) {
        foreach ($dados as $value) {
            if ($this->fp) {
                fputcsv($this->fp, $value, ";");
            }
        }
    }

    public function gerar() {
        fclose($this->fp);
    }

}
