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
				$id = $_SESSION['idC'];
				
				$query = "SELECT * FROM tbl_subcliente WHERE Id_cliente = '$id'";
				$pegaEmail = mysqli_query($conecta,$query);
				$linhas = mysqli_num_rows($pegaEmail);

				while($linhas = mysqli_fetch_array($pegaEmail)){
					$mensagem = "olá ".$linhas['Nome_SubCliente'].", \n
					Esta tendo um evento imperdivel:\n ".$_SESSION['des']." Você não pode perder isso";
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
					$Mailer->Subject = 'Evento imperdive!';
					
					//Corpo da Mensagem
					$Mailer->Body = $mensagem ;
					
					//Corpo da mensagem em texto
					$Mailer->AltBody = 'conteudo do E-mail em texto';
					
					//Destinatario 
					$Mailer->AddAddress($linhas['Email_SubCliente']);
					
					if(!$Mailer->Send())
					{
						echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
					}
				}
			?>
				<script>
					location.href="../ADM/vizualizaEvento.php?&id=<?php echo $id ?>";
				</script>
			
			
		</div>
	</body>
</html>



