
<?php
session_start();
//iniciando a sessao
include_once('../Conexao/conexao.php');	
//iniciando a conexao com o banco de dados



$dadosrecebidossf = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//recebendo os dados do formulario e guardando em um vetor

$dadosrecebidos = array_map('trim',$dadosrecebidossf);
//usando a funcao trim para tirar os espacos no comeco ou final de cada campo
$erro = false;
//iniciando uma variavel que vai dizer caso haja um erro

echo "<script>
		function redirecionar(){
			location.href='../ADM/listaCliente.php';
		}
		function redirecionar1(){
			location.href='../ADM/cadastroCliente.php';
		}
	 </script>";

if(in_array("",$dadosrecebidos))
{
	//caso exista algum campo em branco
	$erro = true;
	//variavel de erro se torna verdadeira, ou seja existe um erro
	
	$_SESSION['msgCP'] = true;
	//criando uma variavel de sessao que vai receber uma mensagem de erro
	//CP = Campos Preenchidos 
	//Todos os campos devem ser preenchidos
	echo "<script>redirecionar1()</script>";
}
else
{
	//casos todos os campos tenham sido preenchidos
	//vamos verificar se ja existe esse cliente cadastrado no banco de dados
	$verificadados = "SELECT Id_cliente FROM Tbl_cliente WHERE Nome_cliente = '".$dadosrecebidos['Nome_cliente']."'";
	//criando uma linha de busca que vai verificar se existe algum usuario com mesmo nome
	$buscadados = mysqli_query($conecta,$verificadados);
	//executando a busca no banco de dados
	if(($buscadados) AND ($buscadados -> num_rows != 0))
	{
		//caso a busca seja verdadeira ou o banco de dados tenha achado alguma linha
		//de resposta entraremos nesse erro 
		$erro = true; 
		$_SESSION['msgUU'] = true; /*UU = Usuario Utilizado / Este usuário já está sendo utilizado*/
		echo "<script> location.href='../ADM/cadastroCliente.php' </script>	";
	}
	$verificadados = "SELECT Id_cliente FROM Tbl_cliente WHERE Email_cliente = '".$dadosrecebidos['Email_cliente']."'";
	//criando uma linha de busca que vai verificar se existe algum usuario com mesmo email
	$buscadados = mysqli_query($conecta,$verificadados);
	//executando a busca no banco de dados
	if(($buscadados) AND ($buscadados -> num_rows != 0))
	{
		//caso a busca seja verdadeira ou o banco de dados tenha achado alguma linha
		//de resposta entraremos nesse erro 
		$erro = true;
		$_SESSION['msgEU'] = true; /*EU = Email Utilizado / Este email já está sendo utilizado*/
		echo "<script> location.href='../ADM/cadastroCliente.php' </script>	";
	}
	if (!$erro)
	{
		//caso a variavel de erro continue falsa ele vai inserir os dados no banco
		$colocandodados = "INSERT INTO Tbl_cliente (Nome_cliente, Email_cliente, Telefone_cliente,Celular_cliente, Segmento_cliente, Uf_cliente, Cidade_cliente, Id_usuario) VALUES (
							'".$dadosrecebidos['Nome_cliente']."',
							'".$dadosrecebidos['Email_cliente']."',
							'".$dadosrecebidos['Telefone_cliente']."',
							'".$dadosrecebidos['Celular_cliente']."',
							'".$dadosrecebidos['Segmento_cliente']."',
							'".$dadosrecebidos['Uf_cliente']."',
							'".$dadosrecebidos['Cidade_cliente']."',
							'".$_SESSION['id']."'
							)";
							
							
							
		$inserirdados = mysqli_query($conecta, $colocandodados); 
		//inserindo os dados no banco de dados 
		if(mysqli_insert_id($conecta))
			{
				// checando se os dados foram inseridos com sucesso
				echo "";
				
				
				
				//$_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
				$_SESSION['cadSuc'] = true;
				echo "<script type ='text/javascript' />
						redirecionar();
					</script>";
				
				//caso de certo o usuario vai receber a mensagem 
				//e vai ser redirecionado para a pagina de login
			}
			else
			{
				//caso aconteça algum erro na inserção de dados 
				$_SESSION['errorCad'] = true;
				echo "<script type ='text/javascript' />
						location.href='../ADM/cadastroCliente.php'
					</script>";
				
				//criando uma variavel de sessao que vai receber uma mensagem de erro
				//caso de uma falha na hora de inserir os dados no banco de dados. 
			}
	}
}

?>
