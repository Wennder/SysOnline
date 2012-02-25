<?php
require_once 'classes/base/sistema/PhpMailer.class.php';

class EnvioEmail
{
	public static function sendEmail($params)
	{
		$email = $params ['email'];
		$html = $params ['html'];
		$assunto = $params ['assunto'];
		$arquivos = (isset ( $params ['arquivos'] )) ? $params ['arquivos'] : array ();
		
		$mail = new PHPMailer ( );
		$mail->IsSMTP ();
		
		$mail->Host = "smtp.vooz.com.br"; // Servidor de SMTP
		$mail->SMTPAuth = true; // SMTP com autenticação
		$mail->Username = "promocao@vooz.com.br"; // Seu e-mail completo para autenticacao
		$mail->Password = "promovooz1306"; // Senha do e-mail da linha acima para autenticacao
		$mail->From = "promocao@vooz.com.br"; // E-mail do remetente
		$mail->FromName = "Promoções Vooz"; // Nome de exibição do remetente
		

		if (is_array ( $email ))
		{
			foreach ( $email as $endereco )
			{
				$mail->AddAddress ( $endereco, "" ); // Seu e-mail de destino
			}
		} else
		{
			$mail->AddAddress ( $email, "" ); // Seu e-mail de destino
		}
		
		if (count ( $arquivos ) > 0)
		{
			foreach ( $arquivos as $arquivo )
			{
				$mail->AddAttachment ( $arquivo ); //anexar arquivo
			}
		}
		
		$mail->IsHTML ( true ); // Enviar como HTML
		$mail->Subject = $assunto; // Assunto do e-mail
		$mail->Body = $html; // Corpo do e-mail
		$mail->AltBody = " ";
		if ($mail->Send ())
		{
			return true;
		} else
		{
			return false;
		}
		
	/*
		##---------------------------------------------------
		##  Envio de Emails pelo SMTP Autênticado usando PEAR
		##---------------------------------------------------
		# Mais detalhes sobre o PEAR: 
		#   http://pear.php.net/
		#
		# Mais detalhes sobre o PEAR Mail:
		#   http://pear.php.net/manual/en/package.mail.mail-mime.php
		##---------------------------------------------------
		

		# Faz o include do PEAR Mail e do Mime.
		include_once ("Mail.php");
		include_once ("Mail/mime.php");
		
		# E-mail de destino. Caso seja mais de um destino, crie um array de e-mails.
		# *OBRIGATÓRIO*
		$recipients = $params ['email'];
		
		# Cabeçalho do e-mail.
		$headers = array ('From' => 'promocao@vooz.com.br', # O 'From' é *OBRIGATÓRIO*.
'To' => $params ['email'], 'Subject' => $params ['assunto'] );
		
		# Utilize esta opção caso deseje definir o e-mail de resposta
		# $headers['Reply-To'] = 'EMailDeResposta@DominioDeResposta.com';
		

		# Utilize esta opção caso deseje definir o e-mail de retorno em caso de erro de envio
		# $headers['Errors-To'] = 'EMailDeRerornoDeERRO@DominioDeretornoDeErro.com';
		

		# Utilize esta opção caso deseje definir a prioridade do e-mail
		# $headers['X-Priority'] = '3'; # 1 UrgentMessage, 3 Normal  
		

		# Define o tipo de final de linha.
		$crlf = "\r\n";
		
		# Corpo da Mensagem e texto e em HTML
		//$text = $params ['html'];//'Escreva aqui o texto do seu e-mail';
		$html = $params ['html'];//"<HTML><BODY><font color=blue>$text</font></BODY></HTML>";
		

		# Instancia a classe Mail_mime
		$mime = new Mail_mime ( $crlf );
		
		# Coloca o HTML no email
		$mime->setHTMLBody ( $html );
		
		##  # Anexa um arquivo ao email.
		##  $mime->addAttachment('/home/suapastahome/www/seuarquivo.txt');
		

		# Procesa todas as informações.
		$body = $mime->get ();
		$headers = $mime->headers ( $headers );
		
		# Parâmetros para o SMTP. *OBRIGATÓRIO*
		$params = array ('auth' => true, # Define que o SMTP requer autenticação.
'host' => 'smtp.vooz.com.br', # Servidor SMTP
'username' => 'promocao=vooz.com.br', # Usuário do SMTP
'password' => 'mundi1306' ); # Senha do seu MailBox.
		

		# Define o método de envio
		$mail_object = & Mail::factory ( 'smtp', $params );
		
		# Envia o email. Se não ocorrer erro, retorna TRUE caso contrário, retorna um
		# objeto PEAR_Error. Para ler a mensagem de erro, use o método 'getMessage()'.
		$result = $mail_object->send ( $recipients, $headers, $body );
		if (PEAR::IsError ( $result ))
		{
			return FALSE;
			//echo "ERRO ao tentar enviar o email. (" . $result->getMessage () . ")";
		} else
		{
			return TRUE;
			//echo "Email enviado com sucesso!";
		}*/
	}

}

?>