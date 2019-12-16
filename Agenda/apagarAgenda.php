<!DOCTYPE html>
<?php
	session_start();

	include_once('../Conexao/conexao.php');	
	ob_start();
	
	$idA=$_SESSION['idA'];
	//pegando a id do evento
	$consulta= "DELETE  FROM Tbl_agenda WHERE Id_agenda = ".$idA." LIMIT 1";
	//query pra deletar
	$resultado = mysqli_query($conecta, $consulta);
	//enviando a query
	
	//executando a consulta no BD
	$linhas = mysqli_affected_rows($conecta);
	// vendo se alguma linha foi afetada no banco de dados
	
	if ($linhas == 1)
	{
		$_SESSION['apagaA'] = TRUE;
		echo "<script>
			location.href='agenda.php';
			</script>";
	}
	else
	{
		$_SESSION['erroAA'] = TRUE;
		echo "<script>
			location.href='agenda.php';
			</script>";
	}

	?>