<?php
	ob_start();
	//inicia um espaço na memória que armazena os dados
	//antes de enviar para o navegador
	include_once('../Seguranca/seguro.php');	
	//certificando que só usuarios logados acessarao a pagina 
	
	include_once('../Conexao/conexao.php');
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Cadastro de clientes</title>
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<link rel = "stylesheet" href = "../css/estiloCadastroCliente.css" type = "text/css"/>

		<link rel = "stylesheet" href = "../css/estiloCadastroClienteMob.css" type = "text/css"/>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

		<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script>
	        function verificarNome(){

	            var texto=document.getElementById("verificaNome").value;

	            for (letra of texto){

	                if (!isNaN(texto)){

	                    alert("Não digite números");
	                    document.getElementById("verificaNome").value="";
	                    return;
	                }

	                letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"

	                var ok = false;
	                for (letra2 of letraspermitidas ){

	                    if (letra==letra2){

	                        ok=true;
	                    }

	                 }

	                 if (!ok){
	                    alert("Não digite caracteres que não sejam letras ou espaços no campo!");
	                    document.getElementById("verificaNome").value="";
	                    return; 
	                 }
	            }
	        }

	        function verificarCidade(){

	            var texto=document.getElementById("verificaCidade").value;

	            for (letra of texto){

	                if (!isNaN(texto)){

	                    alert("Não digite números");
	                    document.getElementById("verificaCidade").value="";
	                    return;
	                }

	                letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"

	                var ok = false;
	                for (letra2 of letraspermitidas ){

	                    if (letra==letra2){

	                        ok=true;
	                    }

	                 }

	                 if (!ok){
	                    alert("Não digite caracteres que não sejam letras ou espaços no campo!");
	                    document.getElementById("verificaCidade").value="";
	                    return; 
	                 }
	            }
	        }

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

	<body id = "cadastroCliente">

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

		<div id = "quadro"></div>

		<div id = "containerCentro">

			<center><p id = "tituloCadCli">Cadastro de Clientes</p></center>
		    	
			<center>
				<!--Caso haja campos não digítados-->
				<?php 
					if(isset($_SESSION['msgCP'])):
				?>
				
					<div id = "msgContent">
						<p>Digíte todos os campos!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['msgCP']);
				?>

				<!--Caso haja um usuário utilizado-->
				<?php 
					if(isset($_SESSION['msgUU'])):
				?>
				
					<div id = "msgContent">
						<p>Usuário já utilizado!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['msgUU']);
				?>

				<!--Caso haja um email utilizado-->
				<?php 
					if(isset($_SESSION['msgEU'])):
				?>
				
					<div id = "msgContent">
						<p>Email já utilizado!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['msgEU']);
				?>
				<?php
					if(isset($_SESSION['errorCad'])):
				?>
					<div id = "msgContent">
						<p align = "center">Erro ao cadastrar!</p>
					</div>
				<?php 
					endif;
					unset($_SESSION['errorCad']);
				?>
			</center>

			<br>
			<script src="../js/jquery.min.js"></script>
			<script src="../js/jquery.mask.js"></script>
			<script>
				$(document).ready(function(){
					$('#tel_ddd').mask('(00) 0000-0000');
					$('#cel_ddd').mask('(00) 00000-0000');
				})	
			</script>

			<div id = "FormContent">
			
				<form method = "post" action = "validaCadCliente.php">

					<table>
						<tr>

							<td class = "sumirMob">Nome do cliente:</td>
							<td> 
								<input type = "text" name = "Nome_cliente" id = "verificaNome" required onchange="verificarNome()"
								placeholder = "Nome do cliente">
							</td>
						</tr>

						<tr>

							<td class = "sumirMob">E-mail do cliente:</td><td> 
								<input type = "email" name = "Email_cliente" required placeholder = "E-mail do cliente">
							</td>

						</tr>

						<tr>

							<td class = "sumirMob">Telefone do cliente:</td><td>
								<input type = "text" id="tel_ddd" name = "Telefone_cliente" required 
								placeholder = "Telefone do cliente">
							</td>

						</tr>
						
						<tr>

							<td class = "sumirMob">Celular do cliente:</td><td>
								<input type = "text" id="cel_ddd" name = "Celular_cliente" required 
								placeholder="Celular do cliente">
							</td>

						</tr>
						
						
						
						<tr>

							<td class = "sumirMob">Segmento do cliente:</td><td>
								<input type = "text" name = "Segmento_cliente" required
								placeholder = "Segmento do cliente">
							</td>

						</tr>
						
						<tr>	
							<td class = "sumirMob">Estado do cliente:</td><td>
								<select name = "Uf_cliente">
									<option selected>AC</option>
									<option>AL</option>
									<option>AP</option>
									<option>AM</option>
									<option>BA</option>
									<option>CE</option>
									<option>DF</option>
									<option>ES</option>
									<option>GO</option>
									<option>MA</option>
									<option>MT</option>
									<option>MS</option>
									<option>MG</option>
									<option>PA</option>
									<option>PB</option>
									<option>PR</option>
									<option>PE</option>
									<option>PI</option>
									<option>RJ</option>
									<option>RN</option>
									<option>RS</option>
									<option>RO</option>
									<option>RR</option>
									<option>SC</option>
									<option>SP</option>
									<option>SE</option>
									<option>TO</option>
								</select>
							</td>

						</tr>

						<tr>
								
							<td class = "sumirMob">Cidade do cliente:</td><td>	
								<input type = "text" name = "Cidade_cliente" id = "verificaCidade" required
								onchange="verificarCidade()" placeholder = "Cidade do cliente">
							</td>
						</tr>

						<tr>
							<td class = "sumirMob"></td><td><input type = "submit"/></td>
						</tr>
					</table>
				</form>
				
			</div>
		</div>
	</body>	
</html>