<!DOCTYPE html>

<?php
session_start();
//iniciando os dados que serão guardados em uma sessão.

include_once('../Conexao/conexao.php');
//incluindo a conexão com o BD



$btnLogin = filter_input(INPUT_POST, 'btnLogin',FILTER_SANITIZE_STRING);
/*filter_input -> é uma função que filtra os dados de um determinado campo
No caso acima é usado para filtrar o botão de login, para saber se o usuário clicou nele mesmo
assim evita de alguém entrar diretamente pela URL, obrigando a pessoa a fazer login.
Os paramêtros são, o método que está sendo passado os dados, o campo a ser filtrado, e a
opção de filtro, a usada acima é para impedir que usuário coloque tags de html no campo
*/

if($btnLogin)
{
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input (INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

	if (!empty($usuario) AND !empty($senha))
	{
		$buscausuario = "SELECT Id_usuario, Nome_usuario, Email_usuario, Senha_usuario FROM Tbl_usuarios WHERE Username_usuario = '$usuario' LIMIT 1 ";
		//colocando a busca em uma variável
		
		$resultado = mysqli_query($conecta,$buscausuario);
		//fazendo a busca no banco de dados.
		//os parametros são a conexão e a string de busca. 
		
		if($resultado)
		{
			//caso o usuario exista no banco de dados
			
			$registrousuario = mysqli_fetch_assoc($resultado);
			//essa função vai ler todos os dados do usuário que foi encontrado.
			//e guardar em uma variavel do tipo vetor.
			
			if(password_verify($senha, $registrousuario['Senha_usuario']))
				
			{
				//verifica se a senha é igual com a do banco de dados
				//usando especificamente para senhas criptografadas.
				
				$_SESSION['id'] = $registrousuario['Id_usuario'];
				$_SESSION['nome'] = $registrousuario['Nome_usuario'];
				//pegando a variavel do banco de dados e guardando em uma de sessao
				header("Location: ../ADM/index.php");
				//redirecionando para a proxima pagina 
				
			}	
			else
			{
				//caso a senha não seja a mesma
				
				$_SESSION ['msgSV'] = true; //SV = Senha Valida
				//criando uma variavel de sessão que vai me dar uma mensagem de erro

				header("Location: login.php");
				//redirecionando para a pagina de login com mensagem de erro. 
			}
		}
	} 
	
	else
	{
		$_SESSION ['msgUSV'] = true; //USV = Usuario Senha Valida

		header("Location: login.php");
	}
}
else
{
	$_SESSION ['msgAR'] = true; // AR = Área Restrita 
	//váriavel do tipo sessão
	header("Location: login.php");
	//função usada para criar um texto de cabeçalho em uma pagina especifica. 
}
?>