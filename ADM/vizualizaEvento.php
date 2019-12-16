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
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<meta charset='UTF-8'>
	<title>Eventos Cadastrados</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVizualizaEvento.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloVisualizaEventoMob.css"/>

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>


	<script type="text/javascript" src = "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src = "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese.json"></script>

	<script>

		$(document).ready( function () {
		    $('#datatable').DataTable({
            	"language": {
                	"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            	}
        	} );;
		} );
	</script>

	<script>
		$(document).ready(function(){
			$('.botao').click(function(){
				$('.menuList li, .quadroTransp').slideToggle();
			});
		});

		setTimeout(function() {
	        $(".msgScreen").fadeOut().empty();
	    }, 3000);
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
	<a href = "javascript:history.back()"><div id = "back"></div></a>
	
	<?php
		if(isset($_SESSION['cadSucesso'])):
		?>
		<div class = "msgScreen" id = "cadSucMsg">
			<p align = "center">Cadastrado com sucesso!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION ['cadSucesso']);
		?>
		
		<?php
		if(isset($_SESSION['tipo'])):
		?>
		<div class = "msgScreen" id = "tipoImgDifMsg">
			<p align = "center">Tipo da imagem deiferente de png, jpg ou gif,</p>
			<p align = "center">dados cadastrados com sucesso!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION ['tipo']);
		?>
		<?php
		if(isset($_SESSION['evenApa'])):
		?>
		<div class = "msgScreen" id = "deletadoMsg">
			<p align = "center">Evento apagado com sucesso!</p>
		</div>
		<?php 
			endif;
			unset($_SESSION['evenApa']);
		?>
	
<?php if(($resultado) And ($resultado -> num_rows!=0)){?>
	<div id="quadro">
			<div id="contentTable">		
				<h2>Eventos Cadastrados</h2>
				<table id = "datatable" border = "0">
					<thead>
					<tr>
						
						<th></th>
						<th>Nome</th>
						<th class = 'noneMob'>inicio</th>
						<th class = 'noneMob'>final</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php
						while($linhas = mysqli_fetch_array($resultado))
						{
							//ele busca linha por linha e vai comparar com a contagem
							echo "<tr>";
								echo "<td><img src='../img/imgEve/".$linhas['Evento_imagem']."' width='100' height='100'></td>";
								
								echo "<td>".$linhas['Nome_evento']."</td>";
								
								echo "<td class = 'noneMob'>".substr($linhas['Data_inicio'],8,2),
									substr($linhas['Data_inicio'],4,4),
									substr($linhas['Data_inicio'],0,4)."</td>";

								echo "<td class = 'noneMob'>".substr($linhas['Data_termino'],8,2),
									substr($linhas['Data_termino'],4,4),
									substr($linhas['Data_termino'],0,4)."</td>";?>
								
								<td>
								<a href='vizualizarEvento.php?&id=<?php echo $linhas['Id_evento'];?> '><input type='button' name='btnVisualizar' value='Visualizar'/></a>
								</td>
								<td>
								<a href='estatisticasEvento.php?&id=<?php echo $linhas['Id_evento'];?> '><input type='button' name='btnEstatisticas' value='Estatisticas'/></a>
								</td>
							<?php echo "</tr>";
						} 
					
					?></tbody>
				</table>
			</div>
		</div>

			<?php }else {?>
				<div id="quadro1"></div>
		
		<div id="PnCad">
				<center><p>nenhum evento evento cadastrado:
				<a href ='../ADM/CadastroEvento.php?&id=<?php echo $id?>'><input type='button' name='btnIrCadEv' value='Cadastrar' id = "btnIrCadEv"/></a></p></center>

			<?php } ?>
</body>
</html>