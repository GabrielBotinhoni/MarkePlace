<!DOCTYPE html>
<?php
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');
	ob_start();
	
	
	$_SESSION['idE']  = $_GET['id'];
	
	$id = $_GET['id'];
	
	$consulta= "SELECT * FROM tbl_eventos WHERE Id_evento = '$id' LIMIT 1";	
	$busca = mysqli_query($conecta, $consulta);
	
	$consulta1= "SELECT date_format(Data_inicio, '%d/%m/%Y') FROM tbl_eventos WHERE Id_evento = '$id' LIMIT 1";	
	$busca1 = mysqli_query($conecta, $consulta1);
	
	$consulta2= "SELECT date_format(Data_termino, '%d/%m/%Y') FROM tbl_eventos WHERE Id_evento = '$id' LIMIT 1";	
	$busca2 = mysqli_query($conecta, $consulta2);
	
	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	$resultado1 = mysqli_fetch_assoc($busca1);
	$resultado2 = mysqli_fetch_assoc($busca2);
	// jogando os dados da consulta dentro de um vetor

?>
<html>
<head>
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<meta charset='UTF-8'>
	<title>Visualizar Eventos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizarEvento.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVisualizarEventoMob.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}

		function confirmExc() {
		   if (confirm("Tem certeza que deseja evento?")){
		      location.href="excluirEvento.php?&id=<?php echo$resultado['Id_evento'];?>";
		   }
		}
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
			$('.botao').click(function(){
				$('.menuList li, .quadroTransp').slideToggle();
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#userFoto').click(function(){
				$('#userConfig').slideToggle();
			});
		});

		setTimeout(function() {
	        $(".msgScreen").fadeOut().empty();
	    }, 3000);
	</script>
</head>
<body id = "listaCliente">

	<div id = "menu">
		<div id="content">
			<div class = "linkCentro">	
				
				<!--Aqui vira todos os links de ADM-->	
				<a href='../ADM/index.php' id = "areaAdministração">Area de administração</a>
				<a href='../Agenda/agenda.php' class = "link">Agenda</a> 
				<a href='../ADM/cadastroCliente.php' id = "cadastroCliente">Cadastrar Cliente</a> 
				<a href='../ADM/listaCliente.php' id = "listaCliente">Clientes Cadastrados</a> 

			</div>

			<?php 
				$query = "SELECT  `Icon_usuario` FROM `tbl_usuarios` WHERE Id_usuario = '".$_SESSION['id']."'";
				$pesquisaImg = mysqli_query($conecta,$query);
				$resultadoImg = mysqli_fetch_assoc($pesquisaImg);
				?>

				<div id = "userFoto">
				<?php
					if($resultadoImg['Icon_usuario'] != 'placeholder.png'){
						echo '<img src = "../img/iconUsu/'.$resultadoImg["Icon_usuario"].'" id = "BdUserImg">';
					} else{?>
						<img src = "../img/iconUsu/placeholder.png">
				<?php }?>
				</div>

				<div id = "userConfig">
				
				
				<?php

				if($resultadoImg['Icon_usuario'] != 'placeholder.png'){
					echo '<img src = "../img/iconUsu/'.$resultadoImg["Icon_usuario"].'"  id = "BdUserImgPlaceholder">';
					
				} else{?>
					<img src = "../img/iconUsu/placeholder.png">
				<?php }?>
				
				<p>	
					Conectado com<br>
					<b><?php echo $_SESSION['nome']?></b>
				</p>

				<a href = "vizualizaUsuario.php">
					<p>
						<button>Vizualizar minhas informações</button>
					</p>
				</a>

				<p><input type = "submit" value = "Sair" onclick="confirmSair()"/></p>
			</div>
		</div>

		<style>
			#userConfig a p button{
				border-radius:0;
			}
		</style>
		
		<div id = "menuMob">
			<div class = "botao">
				<img src = "../img/logo/menuIcon.png">
			</div>

			<div class = "quadroTransp"></div>

			<div class = "menuList">
				<ul>
					<a href='index.php' class = "link"><li>Area de administração</li></a>
					<a href='cadastroCliente.php' class = "link"><li>Cadastrar Cliente</li></a>
					<a href='listaCliente.php' class = "link"><li>Clientes Cadastrados</li></a>
					<a href='../Agenda/agenda.php' class = "link"><li>Agenda</li></a>
					
					<li><input type = "submit" value = "Sair" onclick="confirmSair()"/></li>
				</ul>
			</div>

		</div>
	</div>


	<a href = "javascript:history.back(-1)"><div id = "back"></div></a>

	<div id="quadro"></div>
	<div id="contentEvent">
	<?php
	if(isset($_SESSION['altExte'])):
	?>
	<div class = "msgScreen" id = "extDifImg">
		<p align = "center">imagem não cadastrada use as extenções, png, jpg ou gif,</p>
		<p align = "center"> dados cadastrados!</p>
	</div>
	<?php 
		endif;
		unset($_SESSION['altExte']);
	?>
	<?php
	if(isset($_SESSION['maiorLimi'])):
	?>
	<div class = "msgScreen" id = "limitMsg">
		<p align = "center">imagem não cadastrada maior que o limite de 2m,</p>
		<p align = "center">dados cadastrados!</p>
	</div>
	<?php 
		endif;
		unset($_SESSION['maiorLimi']);
	?>
	
	<?php
	if(isset($_SESSION['eveAltera'])):
	?>
	<div class = "msgScreen" id = "altSucMsg">
		<p align = "center">Alterada com sucesso!</p>
	</div>
	<?php 
		endif;
		unset($_SESSION['eveAltera']);
	?>
		
		<center><h2>Informações do evento</h2></center>
		
		<?php
			if(isset($_SESSION['msgError'])):
			?>
			<div>
				<p align = "center">Erro ao excluir!</p>
			</div>
			<?php 
				endif;
				unset($_SESSION ['msgError']);
		?>
		<?php
		if(isset($_SESSION['cadSucesso'])):
		?>
		<div>
			<p align = "center">Cadastrado com sucesso!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION ['cadSucesso']);
		?>
		
		<?php
		if(isset($_SESSION['limite'])):
		?>
		<div>
			<p align = "center">Imagem maior que 2 mg, os dados foram cadastrados!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION ['limite']);
		?>
		
		<?php
		if(isset($_SESSION['tipo'])):
		?>
		<div>
			<p align = "center">Tipo da imagem deiferente de png, jpg ou gif, dados cadastrados com sucesso!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION ['tipo']);
		?>

		<div class = "zoom">
			<center><p><?php echo "<img src='../img/imgEve/".$resultado['Evento_imagem']."'";?></p></center>
		</div>

		<center><table>
			<tr>
				<td>
					<b>ID: </b>
				</td>
				<td>
					<?php echo $resultado['Id_evento'];?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Nome: </b>
				</td>
				<td>
					<?php echo $resultado['Nome_evento'];?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Descrição: </b>
				</td>
				<td>
					<?php echo $resultado['Descricao_evento'];?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Inicio evento: </b>
				</td>
				<td>
					<?php echo $resultado1["date_format(Data_inicio, '%d/%m/%Y')"];?>
				</td>
			</tr>
			<tr>
				<td>					
					<b>Final evento: </b>
				</td>
				<td>
					<?php echo $resultado2["date_format(Data_termino, '%d/%m/%Y')"];?>
				</td>
			</tr>
				
			<tr>
				<td>					
					<b>Valor recebido: </b>
				</td>
				<td>
					<?php if(isset($resultado["Valor_recebido"])){echo $resultado["Valor_recebido"];}?>
				</td>
			</tr>
		</table></center>
					
		<center>							
			<a href='editarEvento.php?&id=<?php echo$resultado['Id_evento'];?> '><input type='button' name='btnEditar' value='Editar'/></a>

			<input type='button' name='btnExcluir' value='Excluir' id = "exc" onclick="confirmExc()"/>
		</center>

		<center>
			<p id ="linkAcesso">link de acesso:</p>

			<script src="../js/jquery.min.js"></script>
			<script src="../js/link.js"></script>
			
			<form  action="/" method="post">
				<input type="text" value="http://localhost:8080/MarkePlace/ADM/landing.php?&id=<?php echo$resultado['Id_evento'];?>" id="link">						
				<button id="linkEvento">Copiar link</button>
			</form>
		</center>
			
			<script src="../js/jquery-3.4.0.min.js"></script>
			<script src="../js/jquery.mask.js"></script>
			<script>
				$(document).ready(function(){
						$('#Valor').mask('000000000000000.00', {reverse: true});
				})	
			</script>
			
			<br><br>
			
				<?php
				$query = "SELECT  `Valor_final` FROM `tbl_lucro` WHERE Id_evento = ".$_SESSION['idE']."";
				$busca = mysqli_query($conecta,$query);
				$resultado = mysqli_fetch_assoc($busca);
				?>
				<?php
				if(isset($_SESSION['cal'])):
				?>
				<div>
					<p align = "center">Informação inserida com sucesso!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['cal']);
				?>
				<form method="post" action="calculaRendimento.php">
				<center><p>Quantidade de dinheiro gerada:</p> 
					<p><input type = "text" id="Valor" name = "ValFinal"  value ="<?php echo $resultado['Valor_final']  ?>"placeholder = "Ex: 1000.00" required>
					<input type = "submit" id = "btnCalcilar"/></p></center>
				</form>
						
		</div>
	</body>
</html>

