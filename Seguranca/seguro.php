<?php
session_start();

if (empty($_SESSION['id']))
{
	//isso bloqueia a pagina caso a pessoa tente acessar diretamente pelo link ao inves de logar
	$_SESSION ['msg'] = "Você precisa fornecer um usuário e senha válidos!";
	//criando uma variavel de sessão que vai me dar uma mensagem de erro
				
	header("Location: ../Login/login.php");
	//redirecionando para a pagina de login com mensagem de erro. 
}


?>