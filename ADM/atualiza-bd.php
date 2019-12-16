<?php  
	include_once('../Conexao/conexao.php');
	//criando a conexão com BD

	/*if($conecta)
	{
		echo 'conectou C:';
	}*/
	
	$dia = date('Y-m-d', strtotime('-1 month'));
	//pega a data de um mês atrás 
	
	$deleta = "DELETE FROM tbl_agenda WHERE Final_agenda <= '$dia'";
	//deleta todos os eventos de mais de um mês atrás
	
	$resultado = mysqli_query($conecta, $deleta);
	//executa tudo isso ai*/
?>