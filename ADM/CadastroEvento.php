<!DOCTYPE html>
<?php

include_once('../Seguranca/seguro.php');
$_SESSION['idC']  = $_GET['id'];

include_once('../Conexao/conexao.php');

?>
<html>
	<head>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<title>Cadastro evento</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/estiloCadastroEvento.css">

		<link rel="stylesheet" type="text/css" href="../css/estiloCadastroEventoMob.css">

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google--> 

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script src = "../js/jquery-3.4.0.min.js"></script>

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
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.mask.js"></script>
		<script>
			$(document).ready(function(){
					$('#Valor').mask('000000000000000.00', {reverse: true});
				})	
		</script>
		
			<a href = "javascript:history.back(-1);"><div id = "back"></div></a>

			<div id = "quadroDark"></div>
			<div id = "ContainerTextos">
			
				<p id = "tit" align = "center">Cadastro de evento</p>

				<div id = "info">
				<?php
				if(isset($_SESSION['msgData'])):
				?>
				<div>
					<p align = "center">Data inicio precisa ser maior que a final!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION ['msgData']);
				?>
				<?php
					if(isset($_SESSION['msgError'])):
				?>
				<div>
					<p align = "center">Erro ao cadastrar!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION ['msgError']);
				?>	
					<div id="formDiv">
					<form method = "post" action = "validaCadastroEven.php" enctype="multipart/form-data" id = "formulario">
					<table>
					<tr>
						<td class = "noneMob">Nome:</td>
						<td>
							<input type = "text" name = "nomeEvento" placeholder = "nome" required>
						</td>
					</tr>
					<tr>
						<td class = "noneMob">Incio:</td>
						<td>
							<input type = "date" name = "inicioEvento" placeholder = "Começo evento" required>
						</td>
					</tr>
					<tr>
						<td class = "noneMob">Final:</td>
						<td>
							<input type = "date" name = "finalEvento"  placeholder = "Final Evento" required></td>
						</tr>
						<tr>
							<td class = "noneMob">Descrição:</td>
							<td>
								<textarea rows="5" name = "descricaoEvento" placeholder = "Descrição sobre o evento" required></textarea>
							</td>
						</tr>
						<tr>
							<td class = "noneMob">Valor recebido:</td>
							<td>
								<input type = "text" id="Valor" name = "ValRecebido"  placeholder = "Ex: 1000.00" required></td>
							</td>
						</tr>
						<tr>
							<td class = "noneMob">imagem:</td>
							<td>
								<div id = "nomeArquivo">
									<span>Imagem</span>
									<img src = "../img/adm/inputFileCam/cam1.png">
									<input type="file" name="imagemDescricao" id = "imgFile" required>
									<div style="clear:both"></div>
							</td>
						</tr>
						<tr>
							<td class = "noneMob"></td><td><input type = "submit" id = "btnEnviar"/></td>
						</tr>
					</table>
				</form></div>
			</div>
		</div>
	</body>
</html>

