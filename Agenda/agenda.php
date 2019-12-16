<!DOCTYPE html>

<?php
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');
	$pesquisa = "SELECT Id_agenda, Nome_agenda,Inicio_agenda, Final_agenda FROM Tbl_agenda WHERE Id_usuario = ".$_SESSION['id']."";
	$resultado = mysqli_query($conecta,$pesquisa);
	$linhas = mysqli_num_rows($resultado);
	//conta quantas linhas tem na variavel resultado.
?>

<html lang="pt-br">
	<head>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Agenda</title>
		
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloAgenda.css"/>
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloAgendaMob.css"/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->
		<script>
			function confirmSair() {
			   if (confirm("Tem certeza que deseja sair?")) {
			      location.href="../Login/sair.php";
			   }
			}

			/*Função faz a div desaparecer apos 3 segundos*/
			setTimeout(function() {
	            $(".msgScreen").fadeOut().empty();
	        }, 3000);
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
				$pesquisa = mysqli_query($conecta,$query);
				$resultadoImg = mysqli_fetch_assoc($pesquisa);
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

			<style>
				#userConfig{
					font-size:1.20vw;
				}

				#userConfig a p button{
					margin-top:4vw;
				}

				#userConfig p input[type=submit]{
					margin-top:8vw;
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

		<div class ='container'>
		<?php
			if(isset($_SESSION['apagaA'])):
		?>
			<div class = "msgScreen" id = "deletadoMsg">
				<p align = "center">Deletado com sucesso!</p>
			</div>
		<?php 
			endif;
			unset($_SESSION['apagaA']);
		?>
		<?php
			if(isset($_SESSION['SucessoA'])):
		?>
			<div class = "msgScreen" id = "sucessoMsg">
				<p align = "center">Sucesso ao cadastrar!</p>
			</div>
		<?php 
			endif;
			unset($_SESSION['SucessoA']);
		?>			

			<?php 
				if(($resultado) && ($resultado -> num_rows != 0)){
				
				?>

				<div id = "quadroContentIf">

					<?php
						while($linhas = mysqli_fetch_array($resultado))
						{
							//ele busca linha por linha e vai comparar com a contagem
					?>

					<div class = "contentCenter">
					<?php
					if(isset($_SESSION['SucessoA'])):
					?>
					<div>
						<p align = "center">Cadastrado com sucesso!</p>
					</div>
					<?php 
						endif;
						unset($_SESSION['SucessoA']);
					?>
					<div class ='container'>
					<?php
					if(isset($_SESSION['erroA'])):
					?>
					<div>
						<p align = "center">erro ao cadastrar!</p>
					</div>
					<?php 
						endif;
						unset($_SESSION['erroA']);
					?>
						<div class="comp">
							<table>
								<tr>
									<p>
									<b>
										<a href='visualizarAgenda.php?&id=<?php echo $linhas['Id_agenda'];?> '> <?php echo $linhas['Nome_agenda'];?>
											
										</a>


									</b> 
									</p>
									
									<p><b>Início:</b>

									<?php 		

										echo substr($linhas['Inicio_agenda'],8,2),
										substr($linhas['Inicio_agenda'],4,4),
										substr($linhas['Inicio_agenda'],0,4), " (";

										echo substr($linhas['Inicio_agenda'], 11,5), ")";

									echo "</p>";
									echo "<p><b>Fim: </b>";

										echo substr($linhas['Final_agenda'],8,2),
										substr($linhas['Final_agenda'],4,4),
										substr($linhas['Final_agenda'],0,4), " (";

										echo substr($linhas['Final_agenda'], 11,5), ")";
									}
									?>

								</tr>
							</table>

							<a href='cadastrarAgenda.php'><button type="button" class = 'btn' id = "cadEve">Cadastrar novos compromissos</button></a>

							<br>
							<br>
						</div>
					</div>
				</div>

				<?php
					}else{
				?>

				<div id = "quadroElse"></div>
				<div id = "contentNothing">
					<p><b>Nenhum compromisso:</b> 
						<a href='cadastrarAgenda.php'><button type="button">Adicionar</button></a>
					</p>
				</div>

				<?php } ?>

			</div>
	  </body>
</html>
	