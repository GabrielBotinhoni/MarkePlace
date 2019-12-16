<?php
	session_start();
	include_once('../Conexao/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
  	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Agenda</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap DateTimePicker-->
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloCadastrarAgenda.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloCadastrarAgendaMob.css"/>

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
				$resultado = mysqli_fetch_assoc($pesquisa);
			?>

			<div id = "userFoto">
				<?php
					if($resultado['Icon_usuario'] != 'placeholder.png'){
						echo '<img src = "../img/iconUsu/'.$resultado["Icon_usuario"].'" id = "BdUserImg">';
					} else{?>
						<img src = "../img/iconUsu/placeholder.png">
				<?php }?>
			</div>

			<div id = "userConfig">
				
				
				<?php

				if($resultado['Icon_usuario'] != 'placeholder.png'){
					echo '<img src = "../img/iconUsu/'.$resultado["Icon_usuario"].'"  id = "BdUserImgPlaceholder">';
					
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
	<div class='container'>
	<h2><b>Adicionar Compromisso</b></h2>
	<?php
				if(isset($_SESSION['data'])):
				?>
				<div class = "errorMsg">
					<p>Data inicio precisa ser maior que a final!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['data']);
	?>
	<?php
				if(isset($_SESSION['vazio'])):
				?>
				<div class = "errorMsg">
					<p>Preencha todos os campos!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['vazio']);
	?>

		<form method="POST" action="validaCadAgenda.php">
		  <div class="form-group">
			<label for="nome-agenda" class="control-label" id = "labelNoMob">Titulo:</label>
			<input name="Nome_agenda" type="text" class="form-control" id="nome-agenda" placeholder = "Titulo" required>
		  </div>
		  <div class="form-group">
			<label for="inicio_agenda" id = "labelNoMob">Data inicio</label>
				<div class="input-group date data_formato"   data-date-format="dd/mm/yyyy HH:ii:ss" required>
					<input name="Inicio_agenda" class="form-control" type="text" placeholder = "Data de Início">
					<span  class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>   
		  </div>
		   <div class="form-group">
			<label for="final_agenda" id = "labelNoMob">Data final</label>
				<div class="input-group date data_formato"   data-date-format="dd/mm/yyyy HH:ii:ss" required>
					<input name="Final_agenda" class="form-control" type="text" placeholder = "Data final">
					<span  class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>   
		  </div>
		  <div class="form-group">
            <label for="descricao-agenda" class="control-label" id = "labelNoMob">Descrição:</label>
            <textarea name="Descricao_agenda" class="form-control" id="descricao-agenda" placeholder = "Descrição"></textarea>
          </div>
		  <button type="submit" class="btn btn-default">Adicionar</button>
		</form>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- JS -->
    <script src="../js/bootstrap.min.js"></script>
	<!-- JS DateTimePicker-->
	<script src="../js/bootstrap-datetimepicker.min.js"></script>
	<!-- Traducao DateTimePicker-->
	<script src="../js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
	<script type="text/javascript">
		$('.data_formato').datetimepicker({
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1,
			language: "pt-BR"
		});
	</script>
	</body>
</html>