<!DOCTYPE html>
<?php

	include_once('../Conexao/conexao.php');
	session_start();
	
	$pesquisa = "SELECT * FROM tbl_eventos WHERE Id_cliente =".$_SESSION['idC']." ORDER BY 'Id_evento'";
	//criando o parametro de busca
	$resultado = mysqli_query($conecta,$pesquisa);
	//fazendo a busca no banco de dados
	
	$linhas = mysqli_num_rows($resultado);
	//conta quantas linhas tem na variavel resultado.
	
	$id = $_SESSION['idC']
	

?>
<html>
<head>
	<meta charset='UTF-8'>
	<title>Eventos Cadastrados</title>
</head>
<body>
<?php if(($resultado) And ($resultado -> num_rows!=0)){?>
	<h2>Eventos Cadastrados</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Descrição evento</th>
			<th>inicio</th>
			<th>final</th>
			<th>imagem</th>
			<th>ação</th>
			<th><th>
		</tr>
		<?php
			while($linhas = mysqli_fetch_array($resultado))
			{
				//ele busca linha por linha e vai comparar com a contagem
				echo "<tr>";
					echo "<td>".$linhas['Id_evento']."</td>";
					echo "<td>".$linhas['Nome_evento']."</td>";
					echo "<td>".$linhas['Descricao_evento']."</td>";
					echo "<td>".$linhas['Data_inicio']."</td>";
					echo "<td>".$linhas['Data_termino']."</td>";
					echo "<td><img src='../img/imgEve/".$linhas['Evento_imagem']."' width='100' height='100'></td>";?>
					<td>
					<a href='vizualizarEvento.php?&id=<?php echo $linhas['Id_evento'];?> '><input type='button' name='btnVisualizar' value='Visualizar'/></a>
					</td>
					<td>
					<a href='estatisticasEvento.php?&id=<?php echo $linhas['Id_evento'];?> '><input type='button' name='btnEstatisticas' value='Estatisticas'/></a>
					</td>
				<?php echo "</tr>";
			} 
		
		?>
	</table>
<?php }else {?>
	nenhum evento evento cadastrado:
	<a href ='../ADM/CadastroEvento.php?&id=<?php echo $id?>'><input type='button' name='btnIrCadEv' value='Cadastrar' id = "btnIrCadEv"/></a>

<?php } ?>
</body>
</html>