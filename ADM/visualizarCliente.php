<!DOCTYPE html>
<?php
	
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');	
	ob_start();
	
	$id = $_GET['id'];
	$_SESSION['idC'] = $_GET['id'];
	
	$consulta= "SELECT * FROM Tbl_cliente WHERE Id_cliente = '$id' LIMIT 1";	
	$busca = mysqli_query($conecta, $consulta);
	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	// jogando os dados da consulta dentro de um vetor

?>
<html>
<head>
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Visualizar usuário</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVisualizarCliente.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVisualizarClienteMob.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}

		function confirmExc() {
		   if (confirm("Tem certeza que deseja apagar este cliente?")) {
		      location.href="../ADM/apagarCliente.php?&id=<?php echo $resultado['Id_cliente'];?> ";
		   }
		}
	</script>

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

	<a href = "javascript:history.back(-1);"><div id = "back"></div></a>

	<div id = "quadro"></div>
	<div id = "containerInfo">

		<div class = "info">
			<h2>Informações do cliente</h2>
			
			<?php
			if(isset($_SESSION['msgError'])):
			?>
			<div>
				<p align = "center">Erro ao excluir!</p>
				<?php echo $id?>
			</div>
			<?php 
				endif;
				unset($_SESSION ['msgError']);
			?>

			<p><b>Nome:</b><br class = "brNone">
			<?php echo $resultado['Nome_cliente'];?></p>

			<p><b>E-mail:</b><br class = "brNone">
			<?php echo $resultado['Email_cliente'];?></p>

			<p><b>Telefone:</b><br class = "brNone">
			<?php echo $resultado['Telefone_cliente'];?></p>
			
			<p><b>Celular:</b><br class = "brNone">
			<?php echo $resultado['Celular_cliente'];?></p>

			<p><b>Segmento:</b><br class = "brNone">
			<?php echo $resultado['Segmento_cliente'];?></p>
			
			<p><b>Estado: </b><br class = "brNone">
			<?php echo $resultado['Uf_cliente'];?></p>

			<p><b>Cidade: </b><br class = "brNone">
			<?php echo $resultado['Cidade_cliente'];?></p>

		</div>

		<div class = "btAlign">
			
			<a href='../ADM/CadastroEvento.php?&id=<?php echo $resultado['Id_cliente'];?> '>
				<input type='button' name='btnCadastra' value='Cadastrar Evento' class = "btnAlt" id = "btnCadEve">
			</a>

			<a href='../ADM/vizualizaEvento.php?&id=<?php echo $resultado['Id_cliente'];?> '>
				<input type='button' name='btnCadastra' value='Vizualizar Evento' class = "btnAlt" id = "btnVisEve">
			</a>

			<br>

			<a href='../ADM/editarCliente.php?&id=<?php echo $resultado['Id_cliente'];?> '>
				<input type='button' name='btnEditar' value='Editar' class = "btnAlt" id = "btnEdit"/>
			</a>

			
			<input type='button' name='btnExcluir' value='Excluir' class = "btnAlt" id = "btnExc" onclick="confirmExc()">
	
		</div>

	</div>
	
</body>
</html>