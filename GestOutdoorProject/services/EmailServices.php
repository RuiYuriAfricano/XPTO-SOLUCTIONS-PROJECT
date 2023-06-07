<?php

/**
 * Description of EmailServices
 *
 * @author Rui Malemba
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailServices {

    //enviar email
    public function enviarEmail($remetente, $dest, $tipo) {
        // Após registrar o cliente com sucesso
        //para: 1-admin, 2-cliente, 3-gestor
        require_once('email/PHPMailer/src/PHPMailer.php');
        require_once('email/PHPMailer/src/SMTP.php');
        require_once('email/PHPMailer/src/Exception.php');

        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '20201580@isptec.co.ao';
            $mail->Password = 'clariclari03';
            $mail->Port = 587;

            $mail->setFrom('20201580@isptec.co.ao');
            $mail->addAddress($dest);

            $mail->isHTML(true);
            if ($dest == 'yuriafricano03@gmail.com' && $tipo==1) {
                $mail->Subject = 'Novo Cliente XPTO';
            $mail->Body = 'Atenção caro admin!! <br>Ocorreu o registro do cliente: <strong>'. $remetente->getNomeCompleto() . 
                        '</strong> verifica e altere o estado '
                        . 'da adesão e faça a ativação da sua conta.';
                $mail->AltBody = 'Atenção caro admin!! <br>Ocorreu o registro do cliente: <strong>'. $remetente->getNomeCompleto() . 
                        '</strong> verifica e altere o estado '
                        . 'da adesão e faça a ativação da sua conta.';
            } else if($tipo == 2) {
                $mail->Subject = 'Ativação de conta XPTO';
                $mail->Body = 'Atenção!! caro cliente <strong>' . $remetente->getNomeCompleto() . 
                        '</strong> sua conta foi ativada'
                        . ' com sucesso.';
                $mail->AltBody = 'Atenção!! caro cliente <strong>' . $remetente->getNomeCompleto() . 
                        '</strong> sua conta foi ativada'
                        . ' com sucesso.';
            }
            else if($tipo == 3) {
                $mail->Subject = 'Criação de conta XPTO';
                $mail->Body = 'Atenção!! caro gestor <strong>' . $remetente->getNomeCompleto() . '</strong> '
                        . 'Bem vindo a XPTO SOLUCTIONS, foi criada essa conta com o perfil de gestor.<br/>'
                        . 'Tu serás um dos gestores dos OUTDOORS da Empresa, por isso muito sucesso.<br/><br/>'
                        . 'Nota: É obrigatório alterar os seus dados de autenticação no primeiro acesso ao sistema.<br/>'
                        . '<br/>Dados de Autenticação:'
                        . '<br/>Username: '.$remetente->getUsername()
                        . '<br/>Password: '.$remetente->getPassword_();
                $mail->AltBody = 'Atenção!! caro gestor <strong>' . $remetente->getNomeCompleto() . '</strong> '
                        . 'Bem vindo a XPTO SOLUCTIONS, foi criada essa conta com o perfil de gestor.<br/>'
                        . 'Tu serás um dos gestores dos OUTDOORS da Empresa, por isso muito sucesso.<br/><br/>'
                        . 'Nota: É obrigatório alterar os seus dados de autenticação no primeiro acesso ao sistema.<br/>'
                        . '<br/>Dados de Autenticação:'
                        . '<br/>Username: '.$remetente->getUsername()
                        . '<br/>Password: '.$remetente->getPassword_();
            }
            // Definir o cabeçalho "Content-Type" com a codificação UTF-8
            //$mail->addCustomHeader('Content-Type: text/html; charset=UTF-8');
            if ($mail->send()) {
                echo 'Email enviado com sucesso';
            } else {
                echo 'Email não enviado';
            }
        } catch (Exception $e) {
            echo "Erro ao Enviar mensagem: {$mail->ErrorInfo}";
        }
    }
}
