<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<title>Esqueceu sua senha</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estiloEsqueceuSenha.css">
		<link rel="stylesheet" type="text/css" href="../css/estiloEsqueceuSenhaMob.css">
	<head>
	<body>
		<div id = "quadro"></div>
		<div id = "content">
			<form method="post" action ='../email/esqueci_senha.php'>
				
				<h2>ESQUECEU SUA SENHA?</h2>
			<?php
			if(isset($_SESSION['emailN'])):
			?>
			<div>
				<p align = "center">Email não cadastrado!</p>
			</div>
			<?php 
				endif;
				unset($_SESSION['emailN']);
			?>

				<p>Coloque seu e-mail e enviaremos um código <br id = "brNone">
				no seu e-mail com sua senha.</p>

				<p><input type='text' name='email' id='email' placeholder = "E-mail" required/></p>

				<p><input type='submit'name='btnEnviar' value='Entrar'/></p>

				<p align="center"><a href = "login.php">< voltar ao log-in</a></p>
			
			</form>
		</div>
	</body>
</html>
<?php
$letras=array('a', 'D', 'c', 'd', 'A', 'f', 'g', 'K', 'i', 'R', '1', '2', '3', '4', '5'); // caracteres usados para senha
shuffle($letras);
$senha="";


for($i=0;$i<15;$i++){ // 20 = número de caracteres gerados
$senha.="$letras[$i]";
}

$_SESSION['senha'] = $senha; // $senha é o valor gerado

//if(($buscausuario) AND ($buscausuario -> num_rows != 0))

?>
