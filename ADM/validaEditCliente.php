<?php
session_start();

include_once('../Conexao/conexao.php');	

	$dadosrecebidos = filter_input_array(INPUT_POST, FILTER_DEFAULT);	
	
	$query = "SELECT Email_cliente FROM tbl_cliente WHERE Id_cliente = ".$_SESSION['idC']."";
	$pegaemail = mysqli_query($conecta,$query);
	$emailC = mysqli_fetch_assoc($pegaemail);
	
	if ($dadosrecebidos['email'] != $emailC['Email_cliente']){
		$query = "SELECT Email_cliente FROM tbl_cliente WHERE Email_cliente = '".$dadosrecebidos['email']."'";
		$pegaemail = mysqli_query($conecta,$query);
		
		if (($pegaemail) && ($pegaemail -> num_rows !=0)){
			$_SESSION['emailC']= true;
			echo" 
		<script>
			 window.history.back();
		</script>
		";
		exit;
		}else{
			$query = "UPDATE Tbl_cliente SET Nome_cliente ='".$dadosrecebidos['nome']."', 
					   Email_cliente = '".$dadosrecebidos['email']."',
					   Telefone_cliente = '".$dadosrecebidos['telefone']."',
					   Celular_cliente = '".$dadosrecebidos['celular']."',
					   Segmento_cliente = '".$dadosrecebidos['segmento']."'
					   WHERE Id_cliente = '".$dadosrecebidos['id']."' ";
		}
	}else{
	

	$query = "UPDATE Tbl_cliente SET Nome_cliente ='".$dadosrecebidos['nome']."', 
					   Email_cliente = '".$dadosrecebidos['email']."',
					   Telefone_cliente = '".$dadosrecebidos['telefone']."',
					   Celular_cliente = '".$dadosrecebidos['celular']."',
					   Segmento_cliente = '".$dadosrecebidos['segmento']."'
					   WHERE Id_cliente = '".$dadosrecebidos['id']."' ";
	}
	
	$resultado = mysqli_query($conecta,$query);
	
	if($resultado)
	{
		$_SESSION ['msgSucesso'] = true;
		echo "<script>
			location.href='../ADM/listaCliente.php';
			</script>";
	}
	else 
	{
		$_SESSION ['msgError'] = true;
		echo "<script>
			window.history.back();
			</script>";
	}
			
?>