<?php
	include_once('../Seguranca/seguro.php');	
	//certificando que só usuarios logados acessarao a pagina 
	
	include_once('../Conexao/conexao.php');
	
	include_once('atualiza-bd.php');
	//da um delete nos eventos que acabaram a mais de um mes
	
	date_default_timezone_set('America/Sao_Paulo');
	
	$data = date('Y-m-d');
	
	$query = "SELECT * FROM `tbl_email` WHERE Id_usuario = '".$_SESSION['id']."' AND DiaVisitado = '$data'";
	$pesquisa = mysqli_query($conecta, $query);
	if (($pesquisa) && ($pesquisa -> num_rows ==0)){
		header('Location: ../email/enviar_agenda.php'); 
	}
	
?>
<html>
<head>
	<meta charset='UTF-8'>
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<title>Administrativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloAdministrativo.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloAdministrativoMob.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->
	<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet"><!--Fonte do Google-->

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}

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
<body id = "areaAdministração">

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
					<a href='../Agenda/agenda.php' class = "link"><li>Agenda</li></a>
					<a href='cadastroCliente.php' class = "link"><li>Cadastrar Cliente</li></a>
					<a href='listaCliente.php' class = "link"><li>Clientes Cadastrados</li></a>
					
					
					<li><input type = "submit" value = "Sair" onclick="confirmSair()"/></li>
				</ul>
			</div>

		</div>
	</div>
	
	<br><br>

	<?php
	echo "<div id = 'apreImg'><div id = 'qBemVindo'><p>Bem vindo ".$_SESSION['nome']."!</p></div></div>";
	//usando o nome do banco de dados que foi pego na sessao de login
	//e usando ele na variavel de sessao.
	$query = "SELECT COUNT(*) as clientes FROM tbl_cliente WHERE Id_usuario = '".$_SESSION['id']."'";
	$buscacliente = mysqli_query($conecta,$query);
	$resultado = mysqli_fetch_assoc($buscacliente);
	?>

	<div id="hr"></div>

	<div id = "quadros" class = "clearfix">
		<a href='../ADM/listaCliente.php' id = "listaCliente">
		<div class="quadro" id = "q1">
			<?php
			echo '<p  class = "num">'. $resultado['clientes'].'</p><p class = "txtP"><b>Clientes cadastrados</b></p>';
			?>
			
		</div>
		</a>	

		<?php
		$query = "SELECT COUNT(*) as evento FROM tbl_eventos WHERE Id_usuario = '".$_SESSION['id']."' and Data_termino >= '$data'";
		$buscaidcliente = mysqli_query($conecta,$query);
		$final =  mysqli_fetch_assoc($buscaidcliente);

		
		?>
		<a href='../ADM/listaEventoAtivo.php' id = "listaCliente">
		<div class="quadro" id = "q2">
			
			<?php
			echo '<p  class = "num">'.$final['evento']."</p><p class = 'txtP'><b>Evento(s) ativo</b></p>";
			?>
		</div>
		</a>
		
		<?php
		$buscapor = 0;
		$buscaelucro =0;
		
		$query = "SELECT Id_cliente FROM tbl_cliente WHERE Id_usuario = '".$_SESSION['id']."'";
		$buscaidcliente = mysqli_query($conecta,$query);
		$linhas =  mysqli_num_rows($buscaidcliente);
		$final = 0;
		$contador = 0;
		
		while($linhas = mysqli_fetch_array($buscaidcliente)){
			$query = "SELECT AVG(Lucro) AS lucro FROM tbl_lucro WHERE Id_cliente = '".$linhas['Id_cliente']."'";
			$buscaelucro = mysqli_query($conecta,$query);
			$conta = mysqli_fetch_assoc($buscaelucro);
			$final = $final + $conta['lucro'];
			$contador += 1;
			
			
		}
		
		echo "<div class='quadro' id = 'q3'>";
		
			if (($buscaelucro) && ($buscaelucro -> num_rows !=0)){
				$final = $final/$contador;
				echo "<p  class = 'num' id = 'mFin'>".substr($final,0,5)."</p><p id = 'mFin' class = 'txtP'>Media do lucro do(s) seu(s) cliente(s)</p>";
			}else{
				echo "<p class = 'nDado'><b>Nenhum dado cadastrado</b></p>";
			}

		echo "</div>";
		?>

		<?php
		$query = "SELECT Id_cliente FROM tbl_cliente WHERE Id_usuario = '".$_SESSION['id']."'";
		$buscaidcliente = mysqli_query($conecta,$query);
		$linhas =  mysqli_num_rows($buscaidcliente);
		$final = 0;
		$contador = 0;
		
		while($linhas = mysqli_fetch_array($buscaidcliente)){
			$query = "SELECT AVG(Porcentagem) AS porcentagem FROM tbl_lucro WHERE Id_cliente = '".$linhas['Id_cliente']."'";
			$buscapor = mysqli_query($conecta,$query);
			$conta = mysqli_fetch_assoc($buscapor);
			$final = $final + $conta['porcentagem'];
			$contador += 1;
		}

		echo "<div class='quadro' id = 'q4'>";
			if (($buscapor) && ($buscapor -> num_rows !=0)){
				$final = $final/$contador;
				echo "<p class = 'num' id = 'acreFin'>".substr($final,0,3).""."%</p><p id = 'acreFin' class = 'txtP'>de acrescimo no lucro dos clientes</p>";

			}else{
				echo "<p class = 'nDado'><b>Nenhum dado cadastrado</b></p>";
			}
		echo "</div>";
		?>
		
		<?php
		$query = "SELECT  `Nome_agenda` FROM `tbl_agenda` WHERE Id_usuario = '".$_SESSION['id']."' and Final_agenda >= '$data'";
		$eventos = mysqli_query($conecta, $query);
		
			if (($eventos) && ($eventos -> num_rows !=0)){
				$linhas =  mysqli_num_rows($eventos);
				?>
				<a href='../agenda/Agenda.php'>
				
				<?php
				echo "<div class='quadro' id = 'q5'>";
				
				echo "<p id = 'lCen'><b>Não se esqueça você tem esse(s) evento(s) para realizar:</b></p>";

				$i = 1;

				while($linhas = mysqli_fetch_array($eventos)){
					
				if($i<=3){	
					echo "<p id = 'ageCen'>".$linhas['Nome_agenda']."</p>";
				}
				else{
					echo "<p><b>...</b></p>";
				}

				$i=$i+1;

				}

				echo "</div>";

				?>

				</a>

			<?php
				
			}
			else{
				echo "<div class='quadro' id = 'q5'>";
				echo "<p class = 'nDado'><b>Nenhum evento para hoje</b></p>";
				echo "</div>";
			}
		
		?>
	
	</div>

	<div class = "infoInferior">
		<p id = "info1">Copyright © 2019 MarkPlace</p>
		<p id = "info2">markplaceteste@gmail.com</p>
	</div>
</body>
</html>
