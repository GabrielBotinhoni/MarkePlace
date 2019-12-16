<?php 
	include_once('../Seguranca/seguro.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
		<meta charset="UTF-8">
		<title>Estatísticas</title>
		
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloEstatisticasEvento.css"/>
		<link rel = "stylesheet" type = "text/css" href = "../css/estiloEstatisticasEventoMob.css"/>

		<!-- dando o local do JS para o site usar -->
		<script src="https://chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
		<script src="https://chartjs.org/dist/2.8.0/Chart.min.js"></script>
		<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
		<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
		
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
					$('.menuList li, .quadroTransp').toggle();
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

		<?php
		
		$id = $_GET['id'];
		
		// dando ao php um local para ele basear o date
		date_default_timezone_set('America/Sao_Paulo');
		
		//adicionando ao banco de daods
		include_once('../Conexao/conexao.php');
		
		//criando a variavel mes com o mes atual
		$mes = date('m');
		
		//criando a variavel com o ano atual 
		$ano = date('Y');
		
		// jogando o valor do mes em uma sessão 
		$_SESSION['mes'] = $mes;
		//jogando o valor do ano em uma sessão 
		$_SESSION['ano'] = $ano;
		?>		
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
						<button>Visualizar minhas informações</button>
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

	<!-- criando um radio par a seleção de grafico-->
		<div id="quadro"></div>

		<script>
			function resizeChart(x) {
			  if (x.matches) { // If media query matches
			     chart.canvas.parentNode.style.height = '128px';
			  } else {
			    document.body.style.backgroundColor = "pink";
			  }
			}

			var x = window.matchMedia("(max-width: 700px)")
			myFunction(x) // Call listener function at run time
			x.addListener(myFunction) // Attach listener function on state changes
		</script>

		<div id = "tudo" style="width:75%; height:100vw;">
			<canvas id="canvas1" style="width:75%;"></canvas>
		<script>
		
		
		// criando uma variavel em js que esta recebendo a data 
		var dt = new Date();
		
		// pegando a variavel mes da data
		var mes = dt.getMonth();
		
		// selecionando o mes para apresentar dependendo do mes apresentado 
		switch(mes) {
		  case 0:
			mes="janeiro"
			break;
		  case 1:
			mes = "fevereiro"
			break;
		  case 2:
			mes = "Março"
			break;
		  case 3:
			mes = "Abril"
			break;
		  case 4:
			mes = "Maio"
			break;
		  case 5:
			mes = "Junho"
			break;
		  case 6:
			mes = "Julho"
			break;
		  case 7:
			mes = "Agosto"
			break;
	      case 8:
			mes = "Setembro"
			break;
		  case 9:
			mes = "Outubro"
			break;
		  case 10:
			mes = "Novembro"
			break;
		  case 11:
			mes = "Dezembro"
			break;
		}
		
		
			
			var config1 = {
				//tipo de grafico
				type: 'line',
				//dados do grafico
				data: {
				//a lebel adiciona informações que ficam em baixo da tabela
					 labels:
							[
							//pegando as informações do banco de dados
							<?php 
							//denominando o mes de hoje
								$mes = date('m');
	
								//selecionando todos os dias deste mes e mandando para uma variavel
								$contatudot = "SELECT Day(DataEst) FROM tbl_estatisticas WHERE Id_evento = '$id' ORDER BY 'DataEst'";
								
								//usando a query para executar o $contatudot
								$contatudo = mysqli_query($conecta,$contatudot);
								
								//contando quantas linhas tem nas especificações passadas pelo conta tudo 
								$linhas = mysqli_num_rows($contatudo);
								
								//printa todos os dias salvos até 
								while($linhas = mysqli_fetch_array($contatudo)){
								echo "'".$linhas['Day(DataEst)']."', ";
								}?>
							],
					
						// as informações que vão estar nas linhas
				datasets: [{
									// label titulo da linha 
									label: 'Acessos',
									//cor do fundo| dos circulos deas linhas
									backgroundColor:'transparent',
									
									//cor das linhas				
									borderColor: 'rgba(205, 0, 0, 1)',
													//informações da tabela
													
													//Tamanho da linha
									borderWidth: 6,
									
											//data serve para inserir os dados que vão na tabela		
									data: [<?php 
											$mes = date('m');
						
											//repetindo o mesmo processo de cima porem com os dados da tabela
											$contatudot = "SELECT Acessos FROM tbl_estatisticas WHERE Id_evento = '$id' ORDER BY 'DataEst'";
														
											$contatudo = mysqli_query($conecta,$contatudot);
														
											$linhas = mysqli_num_rows($contatudo);
													
											while($linhas = mysqli_fetch_array($contatudo)){
												echo "'".$linhas['Acessos']."', ";
													}?>
											],
											fill:false,
											},
									{
									label: 'Querem receber',
									fill: false,
									backgroundColor: 'transparent',
									borderColor: 'rgba(24, 116, 205, 1)',
									borderWidth: 6,
									data: [<?php 
											$mes = date('m');
						
											$contatudot = "SELECT Enviar FROM tbl_estatisticas WHERE Id_evento = '$id' ORDER BY 'DataEst'";
														
											$contatudo = mysqli_query($conecta,$contatudot);
														
											$linhas = mysqli_num_rows($contatudo);
													
											while($linhas = mysqli_fetch_array($contatudo)){
											echo "'".$linhas['Enviar']."', ";
											}?>
										  ],
									},

						]
				},
				
				
				
				
				//opções de customização da tabela
				options: {
				//resposinsivo para celular
					responsive: true,
					title: {
						display: true,
						//tamanho da fonte
						fontSize:20,
						//titulo da tabela
						text: 'Pessoas que vizitaram seu site'
					},
					//estilo da fonte da tavbela
					labels:{
					fontStyle:"Comic Sans"
					
					}, 
					
					
					//opções de escala da tabela 
					scales: {
					//nome da linha X da tabela (horizontal)
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: mes,
							}
						}],
						//nome da linha Y da tabela (vertical)
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Pessoas'
							}
						}]
					}
					
				
				}
				
				
			};
			
			


			//criando a função que gera as tebelas
			window.onload = function() {
			//variavel contexto pegando todo elemento com id canvas sendo ele 2d
					var ctx1 = document.getElementById('canvas1').getContext('2d');
					window.myLine = new Chart(ctx1, config1);
					
					
			};		
	
	
	</script>
	

<!-- grafico 2 -->	
	<div  style="width: 75%;">
	<canvas id="canvas2"></canvas>
	</div>
	<?php
	$query = "SELECT COUNT(rede_Social) AS nao FROM tbl_subcliente WHERE rede_Social = 'Selecione' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$query);
	$buscaN = mysqli_fetch_assoc($busca);
	
	$query = "SELECT COUNT(rede_Social) AS twitter FROM tbl_subcliente WHERE rede_Social = 'Twitter' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$query);
	$buscaT = mysqli_fetch_assoc($busca);
	
	$query = "SELECT COUNT(rede_Social) AS facebook FROM tbl_subcliente WHERE rede_Social = 'Facebook' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$query);
	$buscaF = mysqli_fetch_assoc($busca);
	
	$query = "SELECT COUNT(rede_Social) AS Instagram FROM tbl_subcliente WHERE rede_Social = 'Instagram' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$query);
	$buscaI = mysqli_fetch_assoc($busca);
	
	$query = "SELECT COUNT(rede_Social) AS outros FROM tbl_subcliente WHERE rede_Social = 'Outros' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$query);
	$buscaO = mysqli_fetch_assoc($busca);
	
	
	
	?>
	
	<script>
	
	
	
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['Redes socias'],
			datasets: [{
				label: 'Não responderam',
				backgroundColor: 'rgba(28,28,28,1)',
				borderColor: 'rgba(28,28,28,1)',
				borderWidth: 1,
				data: [
					<?php echo $buscaN['nao']?>,
					
				]
			}, {
				label: 'Twitter',
				backgroundColor: 'rgba(85,172,238 ,1 )',
				borderColor: 'rgba(85,172,238 ,1 )',
				borderWidth: 1,
				data: [
					<?php echo $buscaT['twitter']?>,
					
				]
				
			}
			, {
				label: 'Instagram',
				backgroundColor: 'rgba(228,64,95 ,1 )',
				borderColor: 'rgba(228,64,95 ,1 )',
				borderWidth: 1,
				data: [
					<?php echo $buscaI['Instagram']?>,
					
				]
				
			}
			, {
				label: 'Facebook',
				backgroundColor: 'rgba(59,89,153 ,1 )',
				borderColor: 'rgba(59,89,153 ,1 )',
				borderWidth: 1,
				data: [
					<?php echo $buscaF['facebook']?>,
					
				]
				
			}
			, {
				label: 'Outros',
				backgroundColor: 'rgba(72, 209, 204, 1)',
				borderColor: 'rgba(72, 209, 204, 1)',
				borderWidth: 1,
				data: [
					<?php echo $buscaO['outros']?>,
					
				]
				
			}
			
			,	{
				label: '',
				backgroundColor: color('rgba(255, 255, 255, 1)').alpha(0.5).rgbString(),
				borderColor: window.chartColors.transparent,
				borderWidth: 1,
				data: [
					0,
					
				]
				
			}
			]

		};

		function barra() {
			var ctx = document.getElementById('canvas2').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Redes sociais usadas'
					}
				}
			});

		};
	
	</script>
	
	
	<?php
	echo "<script>barra()</script>";
	?>
	
	<!-- final grafico -->
		
	</div>	
                                   
		<?php
			$query = "SELECT `Lucro`, `Porcentagem` FROM `tbl_lucro` WHERE Id_evento =".$_SESSION['idE']."";
			$pesquisa = mysqli_query($conecta,$query);
			$resultado = mysqli_fetch_assoc($pesquisa);
		?>
		<?php
		if (($pesquisa) && ($pesquisa -> num_rows !=0)){
		?>
		<div class = "contentRightT"><p>Lucro gerado para o cliente:
			<?php echo $resultado['Lucro']?></p>
			
			<p>Porcentagem do lucro:
			<?php echo $resultado['Porcentagem']."%";?>
			</p>

		<?php

		echo '</div>';
		}else{
		echo '<div class = "contentRightF">';
			echo "<p>Nenhum registro</p>";
		echo '</div>';
		}
		?>
										
	</body>

</html>
