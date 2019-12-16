<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<title>MarkePlace | Sobre nós</title>

	<!--Visualização Desktop-->
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloSobreNos.css"/>

	<!--Visualização Mobile-->
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloSobreNosMob.css">

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
			/*Funções para redirecionar os botões de cadastro e login*/
			function goCadastro() {
			    location.href="../Login/cadastro.php";			   
			}

			function goLogin() {
			    location.href="../Login/login.php";			   
			}

			$(document).ready(function(){
				$('.botao').click(function(){
					$('.menuList li, .quadroTransp').slideToggle();
				});
			});


		</script>
</head>
<body>
	<div class = "menuHome">

			<a href = "#"><img src = "../img/logo/logo.png"></a>

			<div id = "contentLink">
				<a href='../index.php' class = "link">Home</a>
				<a href='#' class = "link">Sobre nós</a>
				
				<input type = "submit" value = "Cadastrar" class = "btnLink" id = "cadastro" onclick="goCadastro()"/>						
				<input type = "submit" value = "Logar" class = "btnLink" id = "login" onclick="goLogin()">
			</div>

			<div id = "menuMob">
				<div class = "botao">
					<img src = "../img/logo/menuIcon.png">
				</div>

				<div class = "quadroTransp"></div>

				<div class = "menuList">
					<ul>
						<a href='../index.php' class = "link"><li>Home</li></a>
						<a href='#' class = "link"><li>Sobre nós</li></a>
						<a href='../Login/cadastro.php' class = "link"><li>Cadastrar</li></a>
						<a href='../Login/login.php' class = "link"><li>Logar</li></a>
					</ul>
				</div>

			</div>
						
		</div>

		<div id="quadro"></div>

		<div id="contetSN">
			<h1>Sobre Nós</h1>

			<p>O markPlace é um site voltado para facilitar a sua vida como profissional do marketing,
			temos o foco em sua organização diária e sua relação com os seus clientes.</p>

			<p>Nele você pode encontrar:

			<li><b>A agenda:</b> te ajuda a organizar os horários de seus compromissos. Tenha tudo sobre
			controle!</li>


			<li><b>Cadastrar os clientes:</b> Esqueceu quando ou onde te solicitaram um serviço? Evite esse
			problema!</li>


			<li><b>Eventos:</b> Tenha uma melhor visualização do que você precisa.</li>


			<li><b>Estatísticas:</b> tenha a noção de como está indo seus serviços. Te ajudamos a melhorar!</li>

			</p>
			
			<p>MarkPlace foi desenvolvido em 2019 como um projeto de tcc (trabalho de comclusão
			de curso) do técnico de nformatica da Etec de Mauá, feito pelos alunos Caroline Lopes,
			Gabriel Botinhoni, Gabrielle Silva, Juan Pablo, Kelly Azevedo, Lucas Paiva e Sabrina Lima.</p>

		</div>

		<br><br>

		<div id = "infoInferior">
			<center><p>MarkePlace 2019</p></center>
		</div>
</body>
</html>