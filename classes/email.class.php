<?php
class Email {


	public static function enviarEmailFila($to, $subject, $msg)	
	{
		/**
		 * 15-08-2022
		 * Envio de email usando o webservice MAILER		 
		*/ 
		
		$ch = curl_init();

		//HOMOLOGACAO
		//curl_setopt($ch, CURLOPT_URL, "http://10.0.77.198/mailer/request-send-email?");

		//PRODUCAO
		curl_setopt($ch, CURLOPT_URL, "http://10.0.1.73/MailerCamacariGovBr/mailer/request-send-email-fila?");
		curl_setopt($ch, CURLOPT_PORT , 8080);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		

		$postfields = array(
			"to" => $to,
			"cliente" => 1,
			"from" => "portaldoservidor@camacari.ba.gov.br",
			"isRequisitarValidacaoEmail" => "false",
			"usuario" => "cgi",
			"senha" => "cgi",
			"subject" => $subject,
			"conteudo" => $msg 
		);

		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		$result = curl_exec($ch);

		//die($result);

		$json_str = $result;
		$json_obj = json_decode($json_str);

		return $json_obj;
	}

	public static function enviarSituacao($situacao ,$email, $interessado, $processo, $assunto, $data, $usuario) {


		/**
		 * 15-08-2022
		 * Envio de email usando o webservice MAILER		 
		*/ 
		
		$ch = curl_init();

		//HOMOLOGACAO
		//curl_setopt($ch, CURLOPT_URL, "http://10.0.77.198/mailer/request-send-email?");

		//PRODUCAO
		curl_setopt($ch, CURLOPT_URL, "http://10.0.1.73/MailerCamacariGovBr/mailer/request-send-email?");
		curl_setopt($ch, CURLOPT_PORT , 8080);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		

		$subject = 'Novo Processo: '.$processo;
		$msg =  'Prezado(a): <span style="font-weight: bold;">' .$interessado.'</span></p><br>'.
				'O seu processo foi '.$situacao.' com sucesso!</p><br>' .
				'<span style="font-size: 16px;font-weight: bold;"><u>Dados do Processo:</u></span></p><br>' .
				'Número: <span style="font-weight: bold;">'.$processo.'</span></p><br>'.
				'Assunto: <span style="font-weight: bold;">'.$assunto.'</span></p><br>'.
				'Data: <span style="font-weight: bold;">'.date("d/m/Y", strtotime($data)).'</span></p><br>'.
				'Hora: <span style="font-weight: bold;">'.date("H:i", strtotime($data)).'</span></p><br>'.
				//'Usuário do sistema: <span style="font-weight: bold;">'.$usuario.'</span></p>'.
				'<p><a href="https://sistemas.camacari.ba.gov.br/sga/processo/visualizacao_externa.php?precisao=igual&numero_processo='.$processo.'" target="_blank">Clique aqui</a> para consultar o seu Processo.</p><br>' .
				'<p><a href="https://sistemas.camacari.ba.gov.br/sga/processo/consulta_externa.php" target="_blank">Clique aqui</a> para consultar outros processos.</p><br>' .
				'<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
				'<img src="https://sistemas.camacari.ba.gov.br/sga/protocolo/images/Mini-Brasao.png" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';

		$postfields = array(
			"to" => $email,
			"cliente" => 1,
			"from" => "sistemas@camacari.ba.gov.br",
			"usuario" => "cgi",
			"senha" => "cgi",
			"subject" => $subject,
			"conteudo" => $msg 
		);

		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		$result = curl_exec($ch);

		//die($result);

		$json_str = $result;
		$json_obj = json_decode($json_str);

		return $json_obj;

		/*
		if(count($json_obj->objErrorServiceList) > 0 )
		{
			//tratar erros
		}
		*/


		/**
		 * DESATIVADO 15-08-2022		 
		 * Envio de email usando o PHPMailer		 
		*/ 
		//DESATIVADO
		/*
		//Envia e-mail para o usuário:
		require("../../../biblioteca/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->SMTPDebug = 1;
		$mail->Host = "mail.camacari.ba.gov.br";
		$mail->From = 'nao.responde@camacari.ba.gov.br';
		$mail->Port = 25;
		//$mail->SMTPAuth = true;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Username = 'cctgi.sistemas@camacari.ba.gov.br';
		//$mail->Password = 'cgVtGdV4CCTG115#';
		$mail->AddAddress($email);
		$mail->FromName = ('Protocolo online');
		$mail->Subject = ('Processo: '.$processo);
		$msg =  'Prezado(a): <span style="font-weight: bold;">' .$interessado.'</span></p>'.
				'O seu processo foi '.$situacao.' com sucesso!</p>' .
				'<span style="font-size: 16px;font-weight: bold;"><u>Dados do Processo:</u></span></p>' .
				'Número: <span style="font-weight: bold;">'.$processo.'</span></p>'.
				'Assunto: <span style="font-weight: bold;">'.$assunto.'</span></p>'.
				'Data: <span style="font-weight: bold;">'.date("d/m/Y", strtotime($data)).'</span></p>'.
				'Hora: <span style="font-weight: bold;">'.date("H:i", strtotime($data)).'</span></p>'.
				//'Usuário do sistema: <span style="font-weight: bold;">'.$usuario.'</span></p>'.
				//'<p><a href="http://sistemas.camacari.ba.gov.br/sga/processo/consulta_publica.php?processo_numero='.$processo.'" target="_blank">Clique aqui</a> para consultar o seu Processo.</p>' .				
				'<p><a href="https://sistemas.camacari.ba.gov.br/sga/processo/consulta_externa.php" target="_blank">Clique aqui</a> para consultar o seu Processo.</p>' .
				'<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
				'<img src="https://sistemas.camacari.ba.gov.br/sga/protocolo/images/Mini-Brasao.png" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';
		$mail->Body = ($msg);
		$mail->AltBody = ("O seu processo é: ") . $processo;
		$return = $mail->Send();
		$mail->ClearAllRecipients();
		//die('Enviado para: '.$email);
		*/
	}

	public static function enviarMovimentacao($movimentacao, $email, $interessado, $processo, $assunto, $data, $usuario, $origem, $destino) {

		/**
		 * 15-08-2022
		 * Envio de email usando o webservice MAILER		 
		*/ 
		
		$ch = curl_init();

		//HOMOLOGACAO
		//curl_setopt($ch, CURLOPT_URL, "http://10.0.77.198/mailer/request-send-email?");

		//PRODUCAO
		curl_setopt($ch, CURLOPT_URL, "http://10.0.1.73/MailerCamacariGovBr/mailer/request-send-email?");
		curl_setopt($ch, CURLOPT_PORT , 8080);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		

		$subject = 'Movimentação do Processo: '.$processo;
		$msg =  'Prezado(a): <span style="font-weight: bold;">' .$interessado.'</span></p><br>'.
				'Uma movimentação foi efetuada para o processo <span style="font-weight: bold;">'.$processo.'</span></p><br>'.
				'<span style="font-size: 16px;font-weight: bold;"><u>Dados do Processo:</u></span></p><br>' .
				'Número: <span style="font-weight: bold;">'.$processo.'</span></p><br>'.
				'Assunto: <span style="font-weight: bold;">'.$assunto.'</span></p><br>'.
				'Movimentação: <span style="color:red;font-weight: bold;">'.$movimentacao.'</span></p><br>'.
				'Data de movimentação: <span style="font-weight: bold;">'.date("d/m/Y h:i:s", strtotime($data)).'</span></p><br>'.
				'Unidade de origem: <span style="font-weight: bold;">'.$origem.'</span></p><br>'.
				'Unidade de destino: <span style="font-weight: bold;">'.$destino.'</span></p><br>'.
				//'Usuário do sistema: <span style="font-weight: bold;">'.$usuario.'</span></p>'.
				'<p><a href="https://sistemas.camacari.ba.gov.br/sga/processo/visualizacao_externa.php?precisao=igual&numero_processo='.$processo.'" target="_blank">Clique aqui</a> para consultar o seu Processo.</p><br>' .
				'<p><a href="https://sistemas.camacari.ba.gov.br/sga/processo/consulta_externa.php" target="_blank">Clique aqui</a> para consultar outros processos.</p><br>' .
				'<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
				'<img src="https://sistemas.camacari.ba.gov.br/sga/protocolo/images/Mini-Brasao.png" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';

		$postfields = array(
			"to" => $email,
			"cliente" => 1,
			"from" => "sistemas@camacari.ba.gov.br",
			"usuario" => "cgi",
			"senha" => "cgi",
			"subject" => $subject,
			"conteudo" => $msg 
		);

		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		$result = curl_exec($ch);

		//die($result);

		$json_str = $result;
		$json_obj = json_decode($json_str);

		return $json_obj;

		/*
		if(count($json_obj->objErrorServiceList) > 0 )
		{
			//tratar erros
		}
		*/


		/**
		 * DESATIVADO 15-08-2022		 
		 * Envio de email usando o PHPMailer		 
		*/ 
		/*
		//Envia e-mail para o usuário:
		require("../../../biblioteca/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->SMTPDebug = 1;
		$mail->Host = "mail.camacari.ba.gov.br";
		$mail->From = 'nao.responde@camacari.ba.gov.br';
		$mail->Port = 25;
		//$mail->SMTPAuth = true;
		//$mail->SMTPSecure = 'ssl';
		//$mail->Username = 'cctgi.sistemas@camacari.ba.gov.br';
		//$mail->Password = 'cgVtGdV4CCTG115#';
		$mail->AddAddress($email);
		$mail->FromName = ('Protocolo online');
		$mail->Subject = ('Movimentação do Processo: '.$processo);
		$msg =  'Prezado(a): <span style="font-weight: bold;">' .$interessado.'</span></p>'.
				'Uma movimentação foi efetuada para o processo <span style="font-weight: bold;">'.$processo.'</span></p>'.
				'<span style="font-size: 16px;font-weight: bold;"><u>Dados do Processo:</u></span></p>' .
				'Número: <span style="font-weight: bold;">'.$processo.'</span></p>'.
				'Assunto: <span style="font-weight: bold;">'.$assunto.'</span></p>'.
				'Movimentação: <span style="color:red;font-weight: bold;">'.$movimentacao.'</span></p>'.
				'Data de movimentação: <span style="font-weight: bold;">'.date("d/m/Y", strtotime($data)).'</span></p>'.
				'Hora de movimentação: <span style="font-weight: bold;">'.date("H:i", strtotime($data)).'</span></p>'.
				'Unidade de origem: <span style="font-weight: bold;">'.$origem.'</span></p>'.
				'Unidade de destino: <span style="font-weight: bold;">'.$destino.'</span></p>'.
				//'Usuário do sistema: <span style="font-weight: bold;">'.$usuario.'</span></p>'.
				//'<p><a href="http://sistemas.camacari.ba.gov.br/sga/processo/consulta_publica.php?processo_numero='.$processo.'" target="_blank">Clique aqui</a> para consultar o seu Processo.</p>' .
				'<p><a href="http://servidor.camacari.ba.gov.br/2015/funcao.php?url=consulta_processo.php" target="_blank">Clique aqui</a> para consultar o seu Processo.</p>' .
				'<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
				'<img src="https://sistemas.camacari.ba.gov.br/sga/protocolo/images/Mini-Brasao.png" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';
		$mail->Body = ($msg);
		$mail->AltBody = ("O seu processo foi movimentado com sucesso, o processo referente é: ") . $processo;
		$return = $mail->Send();
		$mail->ClearAllRecipients();
		//die('Enviado para: '.$email);
		*/
	}
	
	public static function solicitarSenha($servidor, $email, $matricula, $senha) {

		/**
		 * 15-08-2022
		 * Envio de email usando o webservice MAILER		 
		*/ 
		
		$ch = curl_init();

		//HOMOLOGACAO
		//curl_setopt($ch, CURLOPT_URL, "http://10.0.77.198/mailer/request-send-email?");

		//PRODUCAO
		curl_setopt($ch, CURLOPT_URL, "http://10.0.1.73/MailerCamacariGovBr/mailer/request-send-email?");
		curl_setopt($ch, CURLOPT_PORT , 8080);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		

		$subject = 'Solicitação/Alteração de Senha';
	    $msg =  '<p>Prezado(a): <span style="font-weight: bold;">' .$servidor.'</span></p>'.
	   	'Conforme solicitado, sua senha de acesso aos sistemas do município de Camaçari foi gerada.<br><br>'.
	   	'<span style="font-weight: bold;">Matricula: '.$matricula.'</span><br>'.
        '<span style="font-weight: bold;">Senha: '.$senha.'</span><br>'.
        '<p>Atenção para alterar a senha acesse o portal do servidor <a href="http://servidor.camacari.ba.gov.br/portal/index.php" target="_blank">Clique aqui</a>.</p>' .
	    '<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
	    '<img src="https://sistemas.camacari.ba.gov.br/sga/protocolo_novo/images/brasaorelatorio.jpg" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';

		$postfields = array(
			"to" => $email,
			"cliente" => 1,
			"from" => "sistemas@camacari.ba.gov.br",
			"usuario" => "cgi",
			"senha" => "cgi",
			"subject" => $subject,
			"conteudo" => $msg 
		);

	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		$result = curl_exec($ch);

		//die($result);

		$json_str = $result;
		$json_obj = json_decode($json_str);

		return $json_obj;


		/*
		if(count($json_obj->objErrorServiceList) > 0 )
		{
			//tratar erros
		}
		*/


		/**
		 * DESATIVADO 15-08-2022		 
		 * Envio de email usando o PHPMailer		 
		*/ 
		/*
	    //Envia e-mail para o usuário:
	    require("../../../biblioteca/phpmailer/class.phpmailer.php");
	    $mail = new PHPMailer();
	    $mail->IsSMTP();
	    $mail->IsHTML(true);
	    $mail->SMTPDebug = 1;
	    $mail->Host = "mail.camacari.ba.gov.br";
	    $mail->From = 'nao.responde@camacari.ba.gov.br';
	    $mail->Port = 25;
	    //$mail->SMTPAuth = true;
	    //$mail->SMTPSecure = 'ssl';
	    //$mail->Username = 'cctgi.sistemas@camacari.ba.gov.br';
	    //$mail->Password = 'cgVtGdV4CCTG115#';
	    $mail->AddAddress($email);
	    $mail->FromName = ('Prefeitura Municipal de Camaçari - Gestão de Sistemas');
	    $mail->Subject = ('Solicitação/Alteração de Senha');
	    $msg =  '<p>Prezado(a): <span style="font-weight: bold;">' .$servidor.'</span></p>'.
	   	'Conforme solicitado, sua senha de acesso aos sistemas do município de Camaçari foi gerada.<br><br>'.
	   	'<span style="font-weight: bold;">Matricula: '.$matricula.'</span><br>'.
        '<span style="font-weight: bold;">Senha: '.$senha.'</span><br>'.
        '<p>Atenção para alterar a senha acesse o portal do servidor <a href="http://servidor.camacari.ba.gov.br/portal/index.php" target="_blank">Clique aqui</a>.</p>' .
	    '<small style="font-weight: bold;font-style: italic;">Atenção: Não responda a este e-mail. Esta é uma mensagem gerada automaticamente pelo sistema.</small><br/>'.
	    '<img src="https://homologacao.camacari.ba.gov.br/sistemas/sga/protocolo_novo/images/brasaorelatorio.jpg" style="border: none;margin-top: 10px;margin-bottom: 10px;width: 150px;">';
	    $mail->Body = ($msg);
	    $mail->AltBody = ("A sua senha foi gerada com sucesso!!!");
	    $return = $mail->Send();
	    $mail->ClearAllRecipients();
	    //die('Enviado para: '.$email);
		*/
	}
	
}

?>
