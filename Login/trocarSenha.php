<!DOCTYPE html>
<?php 
	include_once('../Conexao/conexao.php');
	session_start();
	
	$query = "SELECT * FROM tbl_usuarios WHERE Email_usuario = '".$_SESSION['email']."' LIMIT 1";
	$pesquisa = mysqli_query($conecta,$query);
	$resultado = mysqli_fetch_assoc($pesquisa);
		
?>
<html>
	<head>
		<title>Trocar Senha</title>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estiloTrocarSenha.css">
		<link rel="stylesheet" type="text/css" href="../css/estiloTrocarSenhaMob.css">
	<head>
	<body>

		<a href = "../ADM/confirmarCodigo.php"><div id = "back"></div></a>

		<div id="quadro"></div>
		<div id="content">
			<h2>TROCAR SENHA</h2>

			<?php
				echo "<p>Olá ".$resultado['Username_usuario']."!</p>";
			?>

			<form method="post" action ='validaTrocarSenha.php'>
				<p>Crie uma nova senha:</p>
				<?php
			if(isset($_SESSION['senhaD'])):
			?>
			<div>
				<p align = "center">Senhas diferentes!</p>
			</div>
			<?php 
				endif;
				unset($_SESSION['senhaD']);
			?>

				<p><input type='password' name='senha' id='senha' placeholder='Digite sua nova senha' /></p>

				<p><input type='password' name='Csenha' id='Csenha' placeholder='Confirme sua nova senha'/></p>

				<p><input type='submit'name='btnEnviar' value='Entrar' /></p>

			</form>
		</div>
	</body>
</html>