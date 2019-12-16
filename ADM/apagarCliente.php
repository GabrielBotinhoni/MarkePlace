<!DOCTYPE html>
<?php
	
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');	
	ob_start();
	
	
	$id=$_GET['id'];
	$consulta0 =  "DELETE FROM tbl_estatisticas WHERE Id_cliente = '$id'";	
	$consulta1= "DELETE FROM tbl_subcliente WHERE Id_cliente = '$id'";	
	$consulta2= "DELETE FROM Tbl_eventos WHERE Id_cliente = '$id'";	
	$consulta3= "DELETE FROM `tbl_lucro` WHERE  Id_cliente = '$id'";	
	$resultado0 = mysqli_query($conecta, $consulta0);
	$resultado1 = mysqli_query($conecta, $consulta1);
	$resultado3 = mysqli_query($conecta, $consulta3);
	$resultado2 = mysqli_query($conecta, $consulta2);

	$consulta= "DELETE FROM tbl_cliente WHERE Id_cliente =  $id";
	$resultado4	= mysqli_query($conecta, $consulta);

	//executando a consulta no BD
	$linhas = mysqli_affected_rows($conecta);
	// vendo se alguma linha foi afetada no banco de dados
	
	
	if ($linhas == 1)
	{
		$_SESSION['msgApaga'] = true; 
		echo $id;
		echo "<script>
				location.href='../ADM/listaCliente.php';
			</script>";
		
	}
	else
	{
		$_SESSION['msgError']= true;
		echo "<script>
			location.href='../ADM/visualizarCliente.php?&id=$id'
			</script>";
		
	}

	?>