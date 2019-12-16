<!DOCTYPE html>
<?php
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');	
	$consulta= "SELECT * FROM tbl_usuarios WHERE Id_usuario = '".$_SESSION['id']."' LIMIT 1";	
	$busca = mysqli_query($conecta, $consulta);
	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	// jogando os dados da consulta dentro de um vetor
?>
<html>
<head>
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset='UTF-8'>
	<title>Minhas informações</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizaUsuario.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizaUsuarioMob.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}

		$(function(){

				$("input:file").siblings("span").text('');
				$("input:file").siblings("span").text($("input:file").val());

				$("input:file").change(function(){

					$(this).siblings("span").text('');
					$(this).siblings("span").text($(this).val().replace(/^.*\\/, "").substring(0,20)+"...");

				});
			});
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
<body>

	<div id = "menu">
		<div id="content">
			<div class = "linkCentro">	
				
				<!--Aqui vira todos os links de ADM-->	
				<a href='../ADM/index.php' id = "areaAdministração">Area de administração</a>
				<a href='../Agenda/agenda.php' id = "agenda">Agenda</a>  
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
	<a href = "javascript:history.back(-1)"><div id = "back"></div></a>

	<div id="quadro"></div>
	<div id="contentAll">
		
		
		<center><h2>Minhas informações</h2></center>

		<center><table>
			<tr>
				<td>
					<b>Nome: </b>
				</td>
				<td>
					<?php echo $resultado['Nome_usuario'];?>
				</td>
			</tr>
			<tr>
				<td>
					<b>E-mail: </b>
				</td>
				<td>
					<?php echo $resultado['Email_usuario'];?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Usuário: </b>
				</td>
				<td>
					<?php echo $resultado['Username_usuario'];?>
				</td>
			</tr>
		</table></center>
		
		
		<center>
		<p>Editar informações:</p> 
		<p><a href ="editaUsuario.php"><button id = "editarBtn">Editar</button></a></p>
		</center>
		<?php 
			if(isset($_SESSION['alte'])):
		?>
		
			<div id = "msgContent">
				<p>senha alterada com sucesso!</p>
			</div>
		<?php 
			endif;
			unset($_SESSION['alte']);
		?>
		
	
		<center>
		<p>Trocar senha:</p> 
		<p><a href ="trocarSenha.php"><button id = "trocarBtn">Trocar</button></a></p>
		</center>
		
		
		
		<form method="post" action="trocarFoto.php" enctype="multipart/form-data">
			<center><p>Alterar minha foto:</p> 
			
			<?php 
					if(isset($_SESSION['errorEx'])):
				?>
				
					<div id = "msgContent">
						<p>Extenção não aceita utilize png, jpg ou gif!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['errorEx']);
				?>
				
				<?php 
					if(isset($_SESSION['tamanho'])):
				?>
				
					<div id = "msgContent">
						<p>Tamanho maior que o limite de 2m!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['tamanho']);
				?>

			<div id = "nomeArquivo">
			<span>Imagem</span>
			<img src = "../img/adm/inputFileCam/cam1.png">	
			<input type="file" name="fotoUsu" id = "imgFile">	

			</center>	

			<p><center><input type = "submit" id = "btnFoto"/></center></p>	
		</form>
						
	</div>
</body>
</html>

