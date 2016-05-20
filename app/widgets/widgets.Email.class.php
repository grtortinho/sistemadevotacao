<?php

final class Email {

    private $host = "";//smpt
    private $username = "";//email
    private $password = "";//senha
    private $port = 465;
    private $secure = 'ssl'; // false tsl sll
    private $mail; // false tsl sll

    function __construct() {
        include ("./app/widgets/mail/class.phpmailer.php");
        include './app/widgets/mail/class.smtp.php';
        $this->mail = new PHPMailer();
        $this->mail->setLanguage('pt');
        $this->mail->isSMTP(); // Define que a mensagem será SMTP
        $this->mail->Host = $this->host; // Endereço do servidor SMTP
        $this->mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
        $this->mail->Username = $this->username; // Usuário do servidor SMTP
        $this->mail->Password = $this->password; // Senha do servidor SMTP
        $this->mail->Port = $this->port;
        $this->mail->SMTPSecure = $this->secure;
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->From = $this->username; // Seu e-mail
        $this->mail->FromName = "CONSELHO ESTADUAL DE POLÍTICA CULTURAL"; // Seu nome
        // Define os dados técnicos da Mensagem
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $this->mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
        $this->mail->WordWrap = 70;
    }

    public function mansangem($email,$nome,$msn) {
        // Define os destinatário(s)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->AddAddress($email, $nome);
        //$this->mail->AddAddress('ciclano@site.net');
        //$this->mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        //$this->mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
        // Define a mensagem (Texto e Assunto)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->Subject = "Confirmação de inscrição"; // Assunto da mensagem
        $this->mail->Body = $msn;
        $this->mail->AltBody = strip_tags($msn);
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$this->mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
        // Envia o e-mail
        $enviado = $this->mail->Send();
        // Limpa os destinatários e os anexos
        $this->mail->ClearAllRecipients();
        $this->mail->ClearAttachments();
        // Exibe uma mensagem de resultado
        if ($enviado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
