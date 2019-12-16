<?php
session_start();
include_once('../Conexao/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<title>Validando...</title>
	<link rel="stylesheet" type="text/css" href="../css/estiloProcEditaEvento.css">
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
	</div>
	<a href = "javascript:history.back()"><div id = "back"></div></a>
<?php
echo "<script>
		function redirecionar(){
		location.href='vizualizarEvento.php?&id=".$_SESSION['idE']."';
	}
	 </script>";



$nome = trim($_POST['nomeEvento']);
$inicio = $_POST['inicioEvento'];
$final = $_POST['finalEvento'];
$descricao = trim($_POST['descricaoEvento']);
$valor = $_POST['Valor_recebido'];
$imagem	= $_FILES['imagem']['name'];
$imagemA = $_POST['imgAntiga'];

if($nome == "" || $descricao ==""){
	$_SESSION['campo'] = true;
	echo" 
	<script>
		 window.history.back();
	</script>
	";
}else{
	if($inicio== ""){
	$inicio = $_SESSION['inicio'];
}

if($final == ""){
	$final = $_SESSION['final'];
	
}
if ($inicio > $final){
	$_SESSION['data'] = true;
	echo" 
	<script>
		 window.history.back();
	</script>
	";
}else{
	if($imagem == ""){
		$query =" UPDATE `tbl_eventos` SET 
		`Nome_evento`='$nome',
		`Data_inicio`='$inicio',
		`Data_termino`='$final',
		`Descricao_evento`='$descricao',
		`Valor_recebido`='$valor',
		`Evento_imagem`='$imagemA'
		WHERE Id_evento = '".$_SESSION['idE']."'
		";
		mysqli_query($conecta,$query);
		$_SESSION['eveAltera']=true;
		echo "<script>
		redirecionar()
		</script>
		";
		
	}else{
					
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

			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['imagem']['error'] != 0){
			?>

			<div id = "quadro"></div>

			<?php
				die("<div id = 'textCentro'>
						<p>Não foi possivel fazer o upload, erro: ". $_UP['erros'][$_FILES['imagem']['error']]."</div>");
				exit; //Para a execução do script
			}

			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){
				$query = "UPDATE `tbl_eventos` SET 
				`Nome_evento`='$nome',
				`Data_inicio`='$inicio',
				`Data_termino`='$final',
				`Descricao_evento`='$descricao',
				WHERE Id_evento = '".$_SESSION['idE']."";
				$envia = mysqli_query($conecta,$query);
				//PRECISA DE MODAL AQUI
				$_SESSION['altExte'] = true;
				echo "
					<script type=\"text/javascript\">
						redirecionar()
					</script>
				";
			}//faz verificação do tamanho do arquivo
			else if($_UP['tamanho'] < $_FILES['imagem']['size']){
				$query = "UPDATE `tbl_eventos` SET 
			`Nome_evento`='$nome',
			`Data_inicio`='$inicio',
			`Data_termino`='$final',
			`Descricao_evento`='$descricao',
			`Evento_imagem`='$imagemA'
			WHERE Id_evento = '".$_SESSION['idE']."'";
			
				$envia = mysqli_query($conecta,$query);
				//PRECISA DE MODAL AQUI
				echo 
				$_SESSION['maiorLimi'] = true;
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
					$nome_final = $_FILES['imagem']['name'];
				}
				//verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'].$nome_final)){
					//upload efetuado com sucesso
					$query =" UPDATE `tbl_eventos` SET 
					`Nome_evento`='$nome',
					`Data_inicio`='$inicio',
					`Data_termino`='$final',
					`Descricao_evento`='$descricao',
					`Evento_imagem`='$nome_final'
					WHERE Id_evento = '".$_SESSION['idE']."'
					";
					$envia = mysqli_query($conecta,$query);
					//PRECISA DE MODAL AQUI
					$_SESSION['eveAltera']=true;
					echo "
					<script type=\"text/javascript\">
						redirecionar()
					</script>
				";
				}else{
					$_SESSION['msgError'] = true;
					echo "
					<script type=\"text/javascript\">
						 window.history.back();
					</script>
				";
				}
			}
		}
	}
}




