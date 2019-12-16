<!DOCTYPE html>
<?php 
	include_once('../Seguranca/seguro.php');
?>
<html>
	<head>
		<title>Alterar Senha</title>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estiloTrocarSenha.css">

		<link rel="stylesheet" type="text/css" href="../css/estiloTrocarSenhaMob.css">
	<head>
	<body>
		<a href = "javascript:history.back()"><div id = "back"></div></a>
		<div id="quadro"></div>
		<div id="content">
			<h2>ALTERAR SENHA</h2>

			<form method="post" action ='validaTrocarSenha.php'>
				<p>Digite a senha antiga</p>
				<?php 
					if(isset($_SESSION['senhaA'])):
				?>
				
					<div id = "msgContent">
						<p>Senha incorreta!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['senhaA']);
				?>
					
				<p><input type='password' name='senhaA' id='senhaA' placeholder='Digite sua antiga senha' /></p>
			
				<p>Crie uma nova senha:</p>
				<?php 
					if(isset($_SESSION['diferente'])):
				?>
				
					<div id = "msgContent">
						<p>Campos diferentes!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['diferente']);
				?>

				<p><input type='password' name='senha' id='senha' placeholder='Digite sua nova senha' /></p>

				<p><input type='password' name='Csenha' id='Csenha' placeholder='Confirme sua nova senha'/></p>

				<p><input type='submit'name='btnEnviar' value='Entrar' /></p>

			</form>
		</div>
	</body>
</html>