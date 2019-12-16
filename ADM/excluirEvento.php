<!DOCTYPE html>
<?php
	
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');	
	ob_start();
	
	$id=$_GET['id'];
	
	$consulta0 =  "DELETE FROM tbl_estatisticas WHERE Id_evento = '$id'";	
	$consulta1= "DELETE FROM tbl_subcliente WHERE Id_evento = '$id'";	
	$consulta2= "DELETE FROM Tbl_eventos WHERE Id_evento = '$id' LIMIT 1";	
	$consulta3= "DELETE FROM `tbl_lucro` WHERE  Id_evento = '$id' LIMIT 1";	
	$resultado0 = mysqli_query($conecta, $consulta0);
	$resultado1 = mysqli_query($conecta, $consulta1);
	$resultado3 = mysqli_query($conecta, $consulta3);
	$resultado2 = mysqli_query($conecta, $consulta2);	//executando a consulta no BD
	$linhas = mysqli_affected_rows($conecta);
	// vendo se alguma linha foi afetada no banco de dados
	
	if ($linhas >= 0)
	{
		//PRECIDA DE MODAL AQUI
		$_SESSION['evenApa'] = true;
		echo "<script>
			location.href='../ADM/vizualizaEvento.php?&id=".$_SESSION['idC']."';
			</script>";
	}
	else
	{
		$_SESSION['msgError'] = true;
		echo "<script>
			location.href='../ADM/vizualizarEvento.php?&id=".$id."'
			</script>";
	}

	?>