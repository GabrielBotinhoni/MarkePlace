<?php
	
	$conecta = mysqli_connect ('localhost','root','','administrativo');
	//criando a conexão com BD
	if(!$conecta)
	{
		//matando script caso exista algum erro
		die ('Erro ao conectar com o banco de dados');
	}
	

?>