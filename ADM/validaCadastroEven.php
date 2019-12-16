<?php
include_once('../Conexao/conexao.php');
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<title>Validando...</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloValidaCadastroEven.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloValidaCadastroEvenMob.css"/>

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
				$('.menuList li, .quadroTransp').toggle();
			});
		});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
				
				<div id = "sobe"><p id = "conectadoCom">	
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
		</div>

		<style>
			#sobe{
				position:absolute;
				margin-top:0vw;
				width:23vw;
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
<?php
include_once('../Conexao/conexao.php');

echo "<script>
		function redirecionar(){
			location.href='../email/enviar_email.php';
		}
	 </script>";



$nome = trim($_POST['nomeEvento']);
$inicio = $_POST['inicioEvento'];
$final = $_POST['finalEvento'];
$descricao = trim($_POST['descricaoEvento']);
$valor = $_POST['ValRecebido'];
$imagem = $_FILES['imagemDescricao']['name'];

if($nome == "" || $descricao ==""){
	echo" 
	<script>
		alert(\"Preencha todos os campos para efetuar o cadastro!\");
		 window.history.back();
	</script>
	";
}else{

	$_SESSION['des'] = $descricao;

	//pasta para onde você quer mandar os arquivo
	$_UP['pasta'] = '../img/imgEve/';

	//Tamanho máximo do arquivo em Bytes
	$_UP['tamanho'] = 1024*1024*100; //5mb

	//Array com as extensoes permitidas
	$_UP['extensoes'] = array('png','jpg', 'jpeg', 'gif');

	//Renomeia o arquivo? (se true, o arquivo será salvo como .jpg e em nome único)
	$_UP['renomeia'] = false;

	//Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

	if($final < $inicio){
	$_SESSION['msgData'] = true;
	echo "<script>
		window.history.back();
		</script>";
}else{


//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
if($_FILES['imagemDescricao']['error'] != 0){
	?>
	<div id="quadro"></div>
	<a href='../ADM/CadastroEvento.php?&id=<?php echo $_SESSION['idC'];?> '>
				<input type='button' name='btnCadastra' value='Cadastrar Evento' class = "btnAlt" id = "btnCadEve">
	</a><?php
	die("<p>Não foi possivel fazer o upload, erro: ". $_UP['erros'][$_FILES['imagemDescricao']['error']]."</p>");
	?>
	<a href='../ADM/CadastroEvento.php?&id=<?php echo $_SESSION['idC'];?> '>
				<input type='button' name='btnCadastra' value='Cadastrar Evento' class = "btnAlt" id = "btnCadEve">
	</a>
	<?php
	exit; //Para a execução do script
}

$extensao = strtolower(end(explode('.', $_FILES['imagemDescricao']['name'])));
	if(array_search($extensao, $_UP['extensoes'])=== false){
		$query = "INSERT INTO `tbl_eventos`(`Id_cliente`,`Id_usuario`, `Nome_evento`, `Data_inicio`, `Data_termino`, `Descricao_evento`, `Valor_recebido`, `Evento_imagem`) 
		VALUES ('".$_SESSION['idC']."','".$_SESSION['id']."','$nome','$inicio','$final','$descricao','$valor','$imagem')";
		$envia = mysqli_query($conecta,$query);
		// PRECISA DE MODAL AQUI
		$_SESSION['tipo'] = true;
		echo 'jorge';
		echo "
			<script type=\"text/javascript\">
				redirecionar()
			</script>
		";
	}//faz verificação do tamanho do arquivo
	else if($_UP['tamanho'] < $_FILES['imagemDescricao']['size']){
		$query = "INSERT INTO `tbl_eventos`(`Id_cliente`,`Id_usuario`, `Nome_evento`, `Data_inicio`, `Data_termino`, `Descricao_evento`, `Valor_recebido`, `Evento_imagem`)
		VALUES ('".$_SESSION['idC']."','".$_SESSION['id']."','$nome','$inicio','$final','$descricao','$valor','$imagem')";
		$envia = mysqli_query($conecta,$query);
		//PRECISA DE MODAL AQUI
		$_SESSION['limite'] = true;
		echo 
					"<script type=\"text/javascript\">
						redirecionar()
					</script>";
	}// passou as verificações, movendo para a pasta foto
	else{
		//verifica se deve trocar o nome do arquivo
		if($_UP['renomeia'] == true){
			//cria um nome baseado no tempo atual
			$nome_final = time().'.jpg';
		}else{
			//matem o nome original do arquivo
			$nome_final = $_FILES['imagemDescricao']['name'];
		}
		//verificar se é possivel mover o arquivo para a pasta escolhida
		if(move_uploaded_file($_FILES['imagemDescricao']['tmp_name'], $_UP['pasta'].$nome_final)){
			//upload efetuado com sucesso
			$query = "INSERT INTO `tbl_eventos`(`Id_cliente`,`Id_usuario`, `Nome_evento`, `Data_inicio`, `Data_termino`, `Descricao_evento`, `Valor_recebido`, `Evento_imagem`)
			VALUES ('".$_SESSION['idC']."','".$_SESSION['id']."','$nome','$inicio','$final','$descricao','$valor','$nome_final')";
			$envia = mysqli_query($conecta,$query);
			//PRECISA DE MODAL AQUI
			$_SESSION['cadSucesso'] = true;
			echo "
			<script type=\"text/javascript\">
				redirecionar()
			</script>
		";
		}else{
			$_SESSION ['msgError'] = true;
			echo "
			<script type=\"text/javascript\">
				location.href='visualizarCliente.php?&id=".$_SESSION['idC']."';
			</script>
		";
		}
	}
}
}
?>
	
	
	</body>
</html>