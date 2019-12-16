<!DOCTYPE html>
<?php
session_start();
?>
<html>
	<head>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<title>Confirmar email</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estiloConfirmarCodigo.css">
		<link rel="stylesheet" type="text/css" href="../css/estiloConfirmarCodigoMob.css">
	<head>
	<body>

		<a href = "../Login/esqueceuSenha.php"><div id = "back"></div></a>

		<div id="quadro"></div>

		<div id = "centro">
			<h2>CONFIRMAÇÃO DE CÓDIGO</h2>
			<?php
			if(isset($_SESSION['cod'])):
			?>
			<div>
				<p align = "center">Código incorreto!</p>
			</div>
			<?php 
				endif;
				unset($_SESSION['cod']);
			?>

			<form method="post" action ='validaConfirmarCod.php'>
				<p>Enviamos um codigo para o seu email.<br id = "mobNone"> Confirme:</p>

				<p><input type='text' name='Ccodigo' id='Ccodigo' placeholder='Digíte a código recebido' required/></p>

				<p><input type='submit'name='btnEnviar' value='Entrar'/></p>
			</form>
		</div>
	</body>
</html>