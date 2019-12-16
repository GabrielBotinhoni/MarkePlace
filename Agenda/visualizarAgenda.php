<?php
	session_start();
	include_once('../Conexao/conexao.php');	
	ob_start();
	$id = $_GET['id'];
	$_SESSION['idA'] = $_GET['id'];
	
	$consulta= "SELECT * FROM Tbl_agenda WHERE Id_agenda = '$id' LIMIT 1";	
	
	$busca = mysqli_query($conecta, $consulta);
	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	// jogando os dados da consulta dentro de um vetor

?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta lang="pt-BR">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Vizualizar compromisso</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizarAgenda.css"/>
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizarAgendaMob.css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

		<script>
			function confirmSair() {
			   if (confirm("Tem certeza que deseja sair?")) {
			      location.href="../Login/sair.php";
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
	<body id = "agenda">

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

				<a href = "../ADM/vizualizaUsuario.php">
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
		
		<div id="quadro"></div>
		<div class='bodyContainer'>
			<h2>Informações do compromisso</h2>
			
				<p><b>Nome: </b>
				<?php echo $resultado['Nome_agenda'];?></p>

				<p><b>Data de inicio: </b>
				<?php echo substr($resultado['Inicio_agenda'],8,2),
					substr($resultado['Inicio_agenda'],4,4),
					substr($resultado['Inicio_agenda'],0,4);?></p>
				
				<p><b>Data de termino: </b>
				<?php echo substr($resultado['Final_agenda'],8,2),
					substr($resultado['Final_agenda'],4,4),
					substr($resultado['Final_agenda'],0,4);?></p>
				
				<p><b>Horário de inicio: </b>
				<?php echo substr($resultado['Inicio_agenda'],11,5);?></p>

				<p><b>Horário de termino: </b>
				<?php echo substr($resultado['Final_agenda'],11,5);?></p>

				<p><b>Descrição: </b>
				<?php echo $resultado['Descricao_agenda'];?></p>
				
	<!--Botao de excluir-->
			<div align="left">
				<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#ModalDeletar">Excluir</button>	
			</div>
	</div>		
	<!--Script do Modal-->	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
	<script src="../js/bootstrap.min.js"></script>
	
	<!-- Modal de Exclusao -->
	<div class="container theme-showcase" role="main">
			<div class="modal fade" id="ModalDeletar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header bg-danger">
							<h4 class="modal-title" id="myModalLabel">Excluir Compromisso</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						</div>
							<div class="modal-body">
								<form method="POST" action="apagarAgenda.php">
									<div class="form-group">
										Você realmente deseja excluir esse compromisso?
									</div>
									<input name = "id" type = "hidden" id = "id-agenda">
									<div class="modal-footer">
										<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-danger">Deletar</button>
									</div>									
								</form>
							</div>	  
					</div>
				</div>
			</div>
		</div>
		<!--Fim do Modal-->	
		<script type='text/javascript'>
			$('#ModalDeletar').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget)
				var id = button.data('id') //recebendo os valores das variaveis
				var modal = $(this)
				//mandando os valores para o campo 
				modal.find('#id-agenda').val(id)
			})
		</script>
	
	</body>			
</html>