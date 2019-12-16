<?php
	include_once('../Conexao/conexao.php');
	include_once('../Seguranca/seguro.php');	
	ob_start();

	$_SESSION['idE']  = $_GET['id'];

	$consulta= "SELECT * FROM tbl_eventos WHERE Id_evento = '".$_SESSION['idE']."' LIMIT 1";	
	$busca = mysqli_query($conecta, $consulta);

	$consulta1= "SELECT date_format(Data_inicio, '%d/%m/%Y') FROM tbl_eventos WHERE Id_evento = '".$_SESSION['idE']."' LIMIT 1";	
	$busca1 = mysqli_query($conecta, $consulta1);

	$consulta2= "SELECT date_format(Data_termino, '%d/%m/%Y') FROM tbl_eventos WHERE Id_evento = '".$_SESSION['idE']."' LIMIT 1";	
	$busca2 = mysqli_query($conecta, $consulta2);

	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	$resultado1 = mysqli_fetch_assoc($busca1);
	$resultado2 = mysqli_fetch_assoc($busca2);

	$_SESSION['inicio'] = $resultado['Data_inicio'];
	$_SESSION['final'] = $resultado['Data_termino'];

?>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src = "../js/jquery-3.4.0.min.js"></script>
	<script src="../js/jquery.mask.js"></script>
    <title>Editar Evento</title>
	
	<script>
		$(document).ready(function(){
				$('#Valor').mask('000000000000000.00', {reverse: true});
			})	
	</script>

    <link rel = "stylesheet" type = "text/css" href = "../css/estiloEditarEvento.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloEditarEventoMob.css"/>

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

	<script>
		$(document).ready(function(){
			$('.botao').click(function(){
				$('.menuList li, .quadroTransp').slideToggle();
			});
		});

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


	<a href = "javascript:history.back()"><div id = "back"></div></a>

	<div id="quadro"></div>
	<div id="contentPage">

	    <div class="container theme-showcase" role="main">
	        
	        <div class="page-header">
	            <center><h1>Editar Evento</h1></center>
	            <br>
	        </div>
			<?php
				if(isset($_SESSION['msgError'])):
				?>
				<div>
					<p align = "center">Erro ao editar!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['msgError']);
			?>
			<?php
				if(isset($_SESSION['data'])):
				?>
				<div>
					<p align = "center">Data inicio precisa ser maior que a final!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['data']);
			?>
			<?php
				if(isset($_SESSION['campo'])):
				?>
				<div>
					<p align = "center">Preencha todos os campos!</p>
				</div>
				<?php 
					endif;
					unset($_SESSION['campo']);
			?>
	        
	        <!---criando um form que redireciona para a edição da imagem-->
	        <!-- multipart/form-data utilizado para o tipo file-->
	        <form method="POST" action="procEditaEvento.php" enctype="multipart/form-data">

	        	<table>
	        		<tr>
	        			<td>
				            Nome do evento
				        </td>
				        <td>
				            <!---Adicionando um campo com o valor do antigo nome no BD-->
				            <input type="text" name="nomeEvento" value="<?php echo $resultado['Nome_evento']?>" required>
				        </td>
				    </tr>
				    <tr>
				    	<td>
				            Descricao do evento
			            </td>
			            <td>
				            <!---Adicionando um campo com o valor da antiga Descrção no BD-->
				            <textarea rows="5" name="descricaoEvento" required>
				                <?php echo $resultado['Descricao_evento']; ?>
				            </textarea>
				        </td>
				    </tr>
				    <tr>
				        <td>
				        	Início do evento:
				        	<b>
				                <div class ="noneMob">(<?php echo $resultado1["date_format(Data_inicio, '%d/%m/%Y')"]; ?>)</div>
				        	</b>
				        </td>
				        <td>
				            <!---Adicionando um campo com o valor do antigo inicio do evento no BD-->
				            <input type="date" name="inicioEvento" placeholder="Começo evento">
				        </td>
				    </tr>
				    <tr>
				    	<td>
				            Final do evento:
				            <b>
				            	<div class ="noneMob">(<?php echo $resultado2["date_format(Data_termino, '%d/%m/%Y')"];?>)</div>
				        	</b>
				        </td>
				        <td>
				            <!---Adicionando um campo com o valor do antigo final do evento no BD-->
				            <input type="date" name="finalEvento" placeholder="Final Evento">
				        </td>
				    </tr>
					<script src="../js/jquery.mask.js"></script>
					<script>
						$(document).ready(function(){
								$('#Valor').mask('000000000000000.00', {reverse: true});
						})	
					</script>
					<tr>
				    	<td>
				            Valor recebido:
						</td>
						<td>
				            <input type="text" id="Valor" name="Valor_recebido" placeholder="ex:1000.00" value='<?php echo $resultado['Valor_recebido'] ?>	'>
				        </td>
				    </tr>
				    <tr>
				        <td>
				            <!---Adicionando um campo para adição da nova foto-->
				            Foto do Evento
				        </td>
				        <td>
				            <div id = "nomeArquivo">
							<span>arquivo.txt</span>
							<img src = "../img/adm/inputFileCam/cam1.png">
							<input type="file" name="imagem" id = "imgFile" >
							<div style="clear:both"></div>
				        </td>
	            	</tr>
	            <!---Vizuaização da antiga foto-->
	            <?php 
				  // jogando o valor da foto em uma variavel

				  $foto = $resultado['Evento_imagem'];
				  //caso a varaivel seja vazia entarra nesta função "sem imagem"
				  if($foto == ""){?>
	                <tr>
	                	<td>
			                <div>
			                    <label>
			                        Foto do Evento Antiga:
			                        
			                    </label>
			            </td>
			            <td>
			                    <div>
			                        Não tem foto antiga
			                    </div>
			                </div>
			            </td>
			        </tr>
	            <?php }

				  //caso diferente ele ira imprir a imagem antiga ba tela
				  if($foto != ""){?>
	               
				  	<tr>
				  		<td>
		                    <div>
		                        <label>
		                            Foto do Evento Antiga
		                        </label>
		                </td>
		                <td>
		                        <div class="col-sm-10">
		                            <div class="zoom">
			                            <?php
											echo "<img src='../img/imgEve/".$resultado['Evento_imagem']."' width='100' height='100'>";
										?>
		                           </div>
		                           <input type="hidden" name="imgAntiga" value='<?php echo $foto ?>'>
		                        </div>
		                    </div>
		                </td>
		            </tr>
		            <tr>
		            	<td></td>
		            	<td>
		                    <?php } ?>
		                    
		                    <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
		                    <button type="submit" class="btn btn-success">Editar</button>
		                </td>
		            </tr>
		        </table>
	        </form>
	</div>
</body>
</html>