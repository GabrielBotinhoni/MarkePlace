<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="img/logo/iconLogo.jpg"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MarkePlace</title>

		<!--Visualização Desktop-->
		<link rel = "stylesheet" type = "text/css" href = "css/estiloHome.css"/>

		<!--Visualização Mobile-->
		<link rel = "stylesheet" type = "text/css" href = "css/estiloHomeMob.css">

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script>
			/*Funções para redirecionar os botões de cadastro e login*/
			function goCadastro() {
			    location.href="Login/cadastro.php";			   
			}

			function goLogin() {
			    location.href="Login/login.php";			   
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

			<a href = "#"><img src = "img/logo/logo.png"></a>

			<div id = "contentLink">
				<a href='index.php' class = "link">Home</a>
				<a href='sobreNos/sobreNos.php' class = "link">Sobre nós</a>
				
				<input type = "submit" value = "Cadastrar" class = "btnLink" id = "cadastro" onclick="goCadastro()"/>						
				<input type = "submit" value = "Logar" class = "btnLink" id = "login" onclick="goLogin()">
			</div>

			<div id = "menuMob">
				<div class = "botao">
					<img src = "img/logo/menuIcon.png">
				</div>

				<div class = "quadroTransp"></div>

				<div class = "menuList">
					<ul>
						<a href='index.php' class = "link"><li>Home</li></a>
						<a href='sobreNos/sobreNos.php' class = "link"><li>Sobre nós</li></a>
						<a href='Login/cadastro.php' class = "link"><li>Cadastrar</li></a>
						<a href='Login/login.php' class = "link"><li>Logar</li></a>
					</ul>
				</div>

			</div>
						
		</div>

		<div id = "slider">

			<figure>

				<div class = "contentSlide">	
					<img src = "img/slides/img1.jpg">
					
				</div>

				<div class = "contentSlide">
					<img src = "img/slides/img2.jpg">
				</div>

				<div class = "contentSlide">
					<img src = "img/slides/img3.jpg">
				</div>

				<div class = "contentSlide">
					<img src = "img/slides/img4.jpg">
				</div>

				<div class = "contentSlide">			
					<img src = "img/slides/img1.jpg">
				</div>

			</figure>
		</div>

		<div id = "sliderMob">

			<figure>

				<div class = "contentSlideMob">	
					<img src = "img/slides/mobile/img1.jpg">
					
				</div>

				<div class = "contentSlideMob">
					<img src = "img/slides/mobile/img2.jpg">
				</div>

				<div class = "contentSlideMob">
					<img src = "img/slides/mobile/img3.jpg">
				</div>

				<div class = "contentSlideMob">
					<img src = "img/slides/mobile/img4.jpg">
				</div>

				<div class = "contentSlideMob">			
					<img src = "img/slides/mobile/img1.jpg">
				</div>

			</figure>
		</div>

		<div id = "funcionalidades" class = "clearfix">

			<div id ="TitleBack">
				
				<img src = "img/logo/engre.png">

				<div id="textoFuncTit">
					<p id = "tituloFuncionalidades">Funcionalidades</p>
					<p id = "subtituloFuncionalidades">Conheça mais sobre o MarkePlace</p>
				</div>
				
			</div>

			<div id="autoM">
				<p>Nosso site busca priorizar a praticidade de um profissional de marketing,
				trazendo a tecnologia<br> para automatizar ações e processos de marketing, reduzir
				trabalhos manuais e aumentar as eficiências das ações. Como:</p>
			</div>

			<div class = "funcBloco" id = "cadClientes">
				<h4>Cadastro de Clientes</h4>

				<p>Você poderá cadastrar seus clientes, 
				e ter a visualização destes, com todas 
				suas informações e contatos de uma forma 
				muito mais organizada, além de poder cadastrar 
				eventos para cada cliente.</p>	
			</div>

			<div class = "funcBloco" id = "cliDatatables">
				<h4>Tabelas de dados</h4>

				<p>Estamos sempre organizando seus dados de forma
				limpa e simples, assim grande parte de seus dados
				cadastrados como de seus clientes e eventos podem
				ser visualizados em tabelas de dados, assim facilitando
				a busca por determinados dados.</p>	
			</div>

			<div class = "funcBloco" id = "calcLucro">
				<h4>Calculo de lucro de seus clientes</h3>	

				<p>Nesta funcionalidade automatizamos calculos e percentuais
				para trazer para você, os seus lucros obtidos pelos clientes</p>
			</div>

			<div class = "funcBloco" id = "agenda">
				<h4>Agenda</h4>	

				<p>Na agenda do MarkePlace você poderá
				se organizar de forma muito mais eficiente
				e com muita facilidade.</p>
			</div>

			<div class = "funcBloco" id = "estEventos">
				<h4>Estatísiticas</h4>	

				<p>Você poderá ter uma visualização muito detalhada,
				sobre pessoas que visitaram seu site, e de por onde
				eles vieram, por meio de gráficos precisos.</p>
			</div>

		</div>

		<div id = "infoInferior">
				<center><p>MarkePlace 2019</p></center>
		</div>
	</body>
</html>