<?php
	include_once('../Conexao/conexao.php');
	include_once('../Seguranca/seguro.php');
	ob_start();
	
	echo "<script>
		function redirecionar(){
			location.href='../ADM/vizualizarEvento.php?&id=".$_SESSION['idE']."';
		}
	 </script>";
	
	$final = $_POST['ValFinal'];
	
	$query0 = "SELECT  `Valor_recebido` FROM `tbl_eventos` WHERE Id_evento = $_SESSION[idE]";
	$busca = mysqli_query($conecta,$query0);
	$resultado = mysqli_fetch_assoc($busca);
	
	$retorno = $final - $resultado['Valor_recebido'];
	$porcentagem = $retorno*100 / $resultado['Valor_recebido'];
	
	$query = "SELECT * FROM `tbl_lucro` WHERE Id_evento = ".$_SESSION['idE']."";
	$procura = mysqli_query($conecta,$query);
	
	if (($procura) and ($procura -> num_rows!=0)){
			$query1 = "UPDATE `tbl_lucro` SET `Valor_final`=$final,`Lucro`=$retorno,`Porcentagem`= $porcentagem WHERE Id_evento= ".$_SESSION['id']."";
			$insere = mysqli_query($conecta,$query1);
			//PRECIDA DE MODAR
			$_SESSION['cal']=true;
				echo "
				<script type=\"text/javascript\">
					redirecionar()
				</script>
				";
			
			}
	else{
		$query1 = "INSERT INTO `tbl_lucro`(`Id_cliente`, `Id_evento`, `Valor_recebido`, `Valor_final`, `Lucro`, `Porcentagem`) VALUES (".$_SESSION['idC'].",".$_SESSION['idE'].",".$resultado['Valor_recebido'].",$final,$retorno,$porcentagem)";
		$insere = mysqli_query($conecta,$query1);
		//PRECISA DE MODAL
		$_SESSION['cal']=true;
		echo "
			<script type=\"text/javascript\">
				redirecionar()
			</script>
				";
		}
		
		
	
	
?>