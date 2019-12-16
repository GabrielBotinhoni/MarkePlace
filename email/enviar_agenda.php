<!DOCTYPE html>
<?php
include_once('../Seguranca/seguro.php');
require 'PHPMailer/PHPMailerAutoload.php';
date_default_timezone_set('America/Sao_Paulo');
$_SESSION['i'] = 0;
include_once('../Conexao/conexao.php');
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
				$id = $_SESSION['id'];
				$date = date('Y-m-d');
				
				$query = "SELECT * FROM Tbl_agenda WHERE Id_usuario = $id";
				$pegaEmail = mysqli_query($conecta,$query);
				$linhas = mysqli_num_rows($pegaEmail);
				
				$query = "SELECT Email_usuario FROM tbl_usuarios WHERE Id_usuario = $id LIMIT 1";
				$busca= mysqli_query($conecta,$query);
				$email = mysqli_fetch_assoc($busca);

				while($linhas = mysqli_fetch_array($pegaEmail)){
					$mensagem = " Ei não se esqueça do seu compromisso ".$linhas['Nome_agenda']." você precisa fazer ".$linhas['Descricao_agenda']." até: ".substr($linhas['Final_agenda'],8,2).substr($linhas['Final_agenda'],4,4).substr($linhas['Final_agenda'],0,4)."";
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
					$Mailer->Subject = 'Compromisso';
					
					//Corpo da Mensagem
					$Mailer->Body = $mensagem ;
					
					//Corpo da mensagem em texto
					$Mailer->AltBody = 'conteudo do E-mail em texto';
					
					//Destinatario 
					$Mailer->AddAddress($email['Email_usuario']);
					
					if(!$Mailer->Send())
					{
						echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
					}
				}
				$query = "INSERT INTO `tbl_email`(`Id_usuario`, `DiaVisitado`) VALUES (".$_SESSION['id'].",'$date')";
				$manda = mysqli_query($conecta,$query);
			?>
			
			
			
			
		</div>
		<script>
				location.href=" ../ADM/index.php";
		</script>
	</body>
</html>

