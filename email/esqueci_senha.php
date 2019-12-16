<!DOCTYPE html>
<?php
	require 'PHPMailer/PHPMailerAutoload.php';
	include_once('../Conexao/conexao.php');
	session_start(); 

?>

	<html><head>
		<style>
			#Desaparecer{
				display:none;
			}
		</style>
	</head>
	<body>
	<div id = "Desaparecer">
	
	<?php
	$email = $_POST['email'];
	$_SESSION['email'] =  $email;

	
	$query = "SELECT Email_usuario FROM tbl_usuarios WHERE Email_usuario = '$email'";
	$busca = mysqli_query($conecta,$query);

	 if (($busca) && ($busca -> num_rows !=0)){
		$mensagem = "Sua senha é: ".$_SESSION['senha'] ."";
		$Mailer = new PHPMailer();
		
		//Define que será usado SMTP
		$Mailer->IsSMTP();
		
		$Mailer->SMTPDebug = 2;
		//Enviar e-mail em HTML
		$Mailer->isHTML(true);
		
		//Aceitar caracteres especiais
		$Mailer->Charset = 'UTF-8';
		
		//Configurações
		$Mailer->SMTPAuth = true;
		$Mailer->SMTPSecure = 'tls';
		
		//nome do servidor
		$Mailer->Host = 'smtp.gmail.com';
		//Porta de saida de e-mail 
		$Mailer->Port = 587;
		
		//Dados do e-mail de saida - autenticação
		$Mailer->Username = 'markplaceteste@gmail.com';
		$Mailer->Password = 'markplace';
		
		//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
		$Mailer->From = 'markplaceteste@gmail.com';
		
		//Nome do Remetente
		$Mailer->FromName = 'Mark Place';
		
		//Assunto da mensagem
		$Mailer->Subject = 'Recuperar senha e usuario';
		
		//Corpo da Mensagem
		$Mailer->Body = $mensagem ;
		
		//Corpo da mensagem em texto
		$Mailer->AltBody = 'conteudo do E-mail em texto';
		
		//Destinatario 
		$Mailer->AddAddress($email);
		
		if(!$Mailer->Send())
		{
			echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
		}?>
		<script>
			location.href='../Login/confirmarCodigo.php';
		</script>
		
		<?php
	}else{
		$_SESSION['emailN'] = true;
		?>
		<script>
			location.href='../Login/esqueceuSenha.php';
		</script>
		<?php
	}
	
?>
</div>



