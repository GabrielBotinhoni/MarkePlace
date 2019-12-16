<!DOCTYPE html>
<?php
	ob_start();
	//inicia um espaço na memória que armazena os dados
	//antes de enviar para o navegador
	echo "<script>
		function redirecionar(){
			location.href='../ADM/cadastroCliente.php';
		}
	 </script>";
	
	$btnCadUsuario = filter_input(INPUT_POST,'btnCadUsuario', FILTER_SANITIZE_STRING);
	if ($btnCadUsuario)
	{
		include_once ('../Conexao/conexao.php');
		
		$dadosrecebidossf = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		/*essa função recebe os dados e guarda em um vetor
		os parametros passados são o metodo de envio que é post nesse caso
		e se eu quero usar algum filtro, no caso estou usando o padrão
		que é receber tudo como string */
		
		$dadosrecebidosst = array_map('strip_tags', $dadosrecebidossf);
		//fazendo o tratamento de dados com a função array map
		//que serve para ler todos os elementos dentro de um vetor
		//e o strip tag é para tirar qualquer tag hmtl que possa ter vindo por engano
		
		$dadosrecebidos = array_map ('trim', $dadosrecebidosst);
		//mais um tratamento de dados só que dessa vez para tirar os espaços em branco
		//que possam ter sidos digitados por engano. 
		
		$erro = false;
		//variavel de erro que vai checar se deu tudo certo no cadastro.
		
		
		if(in_array('',$dadosrecebidos))
		{	
			//esse se vai percorrer o vetor e ver se não tem dados em branco
			//caso tenha a variavel de erro vai ser verdadeira e os dados não poderão ser inseridos no banco de dados.
			
			$erro = true;
			
			$_SESSION['msgCP'] = true;/*CP = Campos Preenchidos / Todos os campos devem ser preenchidos*/
			//criando uma variavel de sessao que vai receber uma mensagem de erro
		}
		elseif(strlen($dadosrecebidos['senha']) < 6)
		{	
			//verificando se a senha tem no minimo 6 caracteres
			$erro = true;
			
			$_SESSION['msgS6C'] = true; /*S6C = Senha 6 Caractere / A senha deve ter no minímo 6 caracteres*/
			//criando uma variavel de sessao que vai receber uma mensagem de erro
		}
		elseif($dadosrecebidos['senha'] != $dadosrecebidos['csenha'])
		{
			//verificando se a senha e a confirmação de senha são iguais
			$erro = true;
			$_SESSION['msgNC'] = true;/*NC = Não Conferem / As senhas não conferem.*/
			//criando uma variavel de sessao que vai receber uma mensagem de erro
			
		}
		else
		{
			$verificausuario = "SELECT Id_usuario  FROM Tbl_usuarios WHERE Username_usuario  = '".$dadosrecebidos['usuario']."'";
			$buscausuario = mysqli_query($conecta, $verificausuario);
			//aqui eu estou criando uma busca no banco de dados para ver se já existe algum usuário 
			//com o mesmo nome de usuario que está tentando ser cadastrado
			
			if(($buscausuario) AND ($buscausuario -> num_rows != 0))
			{
				// aqui é caso a busca seja verdadeira e ele encontre um usuario com o mesmo nome
				//ele vai acionar a variavel de erro e fazer com o cadastro não aconteça 
				
				$erro = true;
				$_SESSION['msgUU'] = true; /*UU = Usuario Utilizado / Este usuário já está sendo utilizado*/
				
			}
			
			$verificausuario = "SELECT Id_usuario FROM Tbl_usuarios WHERE Email_usuario  = '".$dadosrecebidos['email']."'";
			$buscausuario = mysqli_query($conecta, $verificausuario);
			//criando a busca agora para ver se ja existe o email cadastrado
			if(($buscausuario) AND ($buscausuario -> num_rows != 0))
			{
				// aqui é caso a busca seja verdadeira e ele encontre um usuario com o mesmo nome
				//ele vai acionar a variavel de erro e fazer com o cadastro não aconteça 
				
				$erro = true;
				$_SESSION['msgEU'] = true; /*EU = Email Utilizado / Este email já está sendo utilizado*/
				
			}
		}
	
		if(!$erro)
		{
			//caso não haja erros de validação vai inserir no BD
			
			$dadosrecebidos['senha'] = password_hash($dadosrecebidos['senha'], PASSWORD_DEFAULT);
			//aqui eu estou criptografando a senha 
			//voltar aqui pra ver se eu preciso fazer o mesmo com a confirmação antes de comparar
			
			$colocandodados = "INSERT INTO Tbl_usuarios (Nome_usuario , Email_usuario, Username_usuario, Senha_usuario,Icon_usuario ) VALUES (
							'".$dadosrecebidos['nome']."',
							'".$dadosrecebidos['email']."',
							'".$dadosrecebidos['usuario']."',
							'".$dadosrecebidos['senha']."',
							'placeholder.png'
							)";
			//fazendo a query de inserção na tabela
			
			$inserirdados = mysqli_query($conecta, $colocandodados); 
			//inserindo os dados no banco de dados
			//os parametros são a conexão e a query de inserção

			

			if(mysqli_insert_id($conecta))
			{
				// checando se os dados foram inseridos com sucesso
				
				//$_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
				echo  "<script type ='text/javascript' />
						if (confirm('Usuário cadastrado com sucesso')) {
						redirecionar();
					  } else {
						redirecionar();
					  }
						redirecionar();
					</script>";
				
				//caso de certo o usuario vai receber a mensagem 
				//e vai ser redirecionado para a pagina de login
			}
			else
			{
				//caso aconteça algum erro na inserção de dados 
				echo "<script type ='text/javascript' />
						alert ('Erro ao cadastrar o usuário');
					</script>";
				
				//criando uma variavel de sessao que vai receber uma mensagem de erro
				//caso de uma falha na hora de inserir os dados no banco de dados. 
			}
		}
	
		
	}		
?>

<html>
	<head>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta charset='UTF-8'>
		<title>Cadastro</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloCadastro.css"/>
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloCadastroMob.css">

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

		<script>
	        function verificar(){

	            var texto=document.getElementById("nome").value;

	            for (letra of texto){

	                if (!isNaN(texto)){

	                    alert("Não digite números");
	                    document.getElementById("nome").value="";
	                    return;
	                }

	                letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"

	                var ok = false;
	                for (letra2 of letraspermitidas ){

	                    if (letra==letra2){

	                        ok=true;
	                    }

	                 }

	                 if (!ok){
	                    alert("Não digite caracteres que não sejam letras ou espaços no campo!");
	                    document.getElementById("nome").value="";
	                    return; 
	                 }
	            }
	        }
    	</script>
			
	</head>
	<body>
		
		<a href = "../index.php"><div id = "back"></div></a>

		<div id = "quadro"></div>
		<div id = "contentForm">

			<h1>Cadas<font color="#CD0000">t</font>ro<font color="#CD0000">.</font></h1>
             
			<form  method="post" action="#" class = "deskForm">
				<table>
						<tr>
							<td class = "tdP">
							</td>
							<td>
								<?php
									if(isset($_SESSION['msgCP'])):
								?>

									<div id = "msgContent">
										<p align = "center">Todos os campos devem ser preenchidos!</p>
									</div>

								<?php
									unset($_SESSION['msgCP']);
									endif;			 
								?>

								<?php 
									if(isset($_SESSION['msgS6C'])):
								?>

									<div id = "msgContent">
										<p align = "center">A senha deve ter no minímo 6 caracteres!</p>
									</div>

								<?php 
									unset($_SESSION['msgS6C']);
									endif;			
								?>

								<?php
									if(isset($_SESSION['msgNC'])):
								?>

									<div id = "msgContent">
										<p align = "center">As senhas não conferem!</p>
									</div>

								<?php 
									unset($_SESSION['msgNC']);
									endif;			
								?>
								
								<?php 
									if(isset($_SESSION['msgUU'])):
								?>

									<div id = "msgContent">
										<p align = "center">Este usuário já está sendo utilizado!</p>
									</div>

								<?php 
									unset($_SESSION['msgUU']);
									endif;	
								?>

								<?php 
									if(isset($_SESSION['msgEU'])):
								?>

									<div id = "msgContent">
										<p align = "center">Este email já está sendo utilizado!</p>
									</div>

								<?php
									unset($_SESSION['msgEU']);
									endif;			
								?>
							</td>
						</tr>
						<tr>				
							<td class = "tdP">Nome:</td>
							<td>
								<input type='text' name='nome' id='nome' placeholder = "Digíte seu nome" 
								required onchange="verificar()"/>
							</td>
						</tr>
						<tr>	
							<td class = "tdP">E-mail:</td><td><input type='email' name='email' id='email' 
								placeholder = "Digíte seu e-mail" required/></td>
						</tr>
						<tr>				
							<td class = "tdP">Usuário:</td><td><input type='text' name='usuario' id='usuario' 
								placeholder = "Digíte seu usuário" required/></td>
						</tr>
						<tr>
							<td class = "tdP">Senha:</td><td><input type='password' name='senha' id='senha' 
								placeholder = "Digíte sua senha" required/></td>
						</tr>
						<tr>
							<td class = "tdP">Repita a senha:</td>
							<td><input type='password' name='csenha' id='csenha'  
								placeholder = "Confirme sua senha" required/></td>
						</tr>
						<tr>
							<td class = "tdP"></td><td><input  type='submit' name='btnCadUsuario' value='Cadastrar' /></td>
						</tr>
				</table>

			</form>

			<p id = "pLogar">Já cadastrado? <a href='login.php'>Faça login!</a></p>
		</div>

	</body>
</html>