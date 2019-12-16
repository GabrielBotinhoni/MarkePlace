<?php
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');
	$idusuario = $_SESSION['id'];
	$pesquisa = "SELECT * FROM Tbl_cliente WHERE Id_usuario = '$idusuario' ORDER BY 'Id_cliente'";
	//criando o parametro de busca
	$resultado = mysqli_query($conecta,$pesquisa);
	//fazendo a busca no banco de dados
	
	$linhas = mysqli_num_rows($resultado);
	//conta quantas linhas tem na variavel resultado.
	
?>


<html>
<head>
	<meta charset='UTF-8'>
	<title>Clientes Cadastrados</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloListaCliente.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}
	</script>
</head>
<body id = "listaCliente">

	<div id = "menu">

		<div class = "linkCentro">	
			
			<!--Aqui vira todos os links de ADM-->	
			<a href='../ADM/index.php' id = "areaAdministração">Area de administração</a> 
			<a href='../ADM/cadastroCliente.php' id = "cadastroCliente">Cadastrar Cliente</a> 
			<a href='../ADM/listaCliente.php' id = "listaCliente">Clientes Cadastrados</a> 

		</div>
		<input type = "submit" value = "Sair" onclick="confirmSair()"/>
		
	</div>

	<br><br><br>
	
	<?php if(($resultado) AND ($resultado -> num_rows != 0)){ ?>

	<div id = "ListaCentro">

		<p id = "tituloCliCad" align = "center">Clientes Cadastrados</p>

		<div id = "containerLista">			
			
			<table>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Segmento</th>
					<th>Estado</th>
					<th>Ações</th>
				</tr>
				<?php
					while($linhas = mysqli_fetch_array($resultado))
					{
						//ele busca linha por linha e vai comparar com a contagem
						echo "<tr class = 'tr1'>";
							echo "<td>".$linhas['Id_cliente']."</td>";
							echo "<td>".$linhas['Nome_cliente']."</td>";
							echo "<td>".$linhas['Email_cliente']."</td>";
							echo "<td>".$linhas['Segmento_cliente']."</td>";
							echo "<td align = 'center'>".$linhas['Uf_cliente']."</td>";
							?>
							<td>
								<a href='../ADM/visualizarCliente.php?&id=<?php echo $linhas['Id_cliente'];?> ' class = "tdBtn"><input type='button' name='btnVisualizar' value='Visualizar' id = "btnVisualizar"/></a>
							</td>
							<?php
						echo "</tr>";
					}
			
				?>
			</table>

		</div>
	</div>
	<?php }Else{ ?>
	Nenhum cliente cadastrado:
	
	<a href ='../ADM/cadastroCliente.php'><input type='button' name='btnIrCadCli' value='Cadastrar' id = "btnIrCadCli"/></a>
	 
	
	
	<?php } ?>
</body>
</html>