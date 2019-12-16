<?php

include_once('../Seguranca/seguro.php');
include_once('../Conexao/conexao.php');
$imagem = $_FILES['fotoUsu']['name'];

echo "<script>
		function redirecionar(){
			location.href='../ADM/vizualizaUsuario.php';
		}
	 </script>";

//pasta para onde você quer mandar o arquivo
	$_UP['pasta'] = '../img/iconUsu/';

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
if($_FILES['fotoUsu']['error'] != 0){
	?>
	<div id="quadro"></div>
	<a href='../ADM/vizualizaUsuario.php'>
				<input type='button' name='btnCadastra' value='Cadastrar Evento' class = "btnAlt" id = "btnCadEve">
	</a><?php
	die("<p>Não foi possivel fazer o upload, erro: ". $_UP['erros'][$_FILES['fotoUsu']['error']]."</p>");
	?>
	<a href='../ADM/vizualizaUsuario.php'>
				<input type='button' name='btnCadastra' value='Cadastrar Evento' class = "btnAlt" id = "btnCadEve">
	</a>
	<?php
	exit; //Para a execução do script
}

$extensao = strtolower(end(explode('.', $_FILES['fotoUsu']['name'])));
	if(array_search($extensao, $_UP['extensoes'])=== false){
		$_SESSION['errorEx'] = true;
		echo "
			<script type=\"text/javascript\">
				redirecionar()
			</script>
		";
	}//faz verificação do tamanho do arquivo
	else if($_UP['tamanho'] < $_FILES['fotoUsu']['size']){
		$_SESSION['tamanho'] = true;
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
			$nome_final = $_FILES['fotoUsu']['name'];
		}
		//verificar se é possivel mover o arquivo para a pasta escolhida
		if(move_uploaded_file($_FILES['fotoUsu']['tmp_name'], $_UP['pasta'].$nome_final)){
			//upload efetuado com sucesso
			$query = "UPDATE `tbl_usuarios` SET `Icon_usuario`= '".$nome_final."' WHERE Id_usuario = ".$_SESSION['id']."";
			$envia = mysqli_query($conecta,$query);
			echo "
			<script type=\"text/javascript\">
				alert(\"Imagem cadastrada com sucesso\");
				redirecionar()
			</script>
		";
		}else{
			
			echo "
			<script type=\"text/javascript\">
				location.href='vizualizaUsuario.php';
			</script>
		";
		}
	}

?>