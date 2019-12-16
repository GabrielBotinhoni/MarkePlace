<!DOCTYPE html>

<style>
	#noneResult{
		display:none;
	}
</style>

<div id = "noneResult">
<?php

include_once('../Conexao/conexao.php');

session_start();

date_default_timezone_set('America/Sao_Paulo');

$data = date ('Y-m-d');


$nome = $_POST['nomeSubClit'];
$email = $_POST['emailSubClit'];
$rede = $_POST['redeSocial'];
$id= $_SESSION['idE'];
$receber = $_POST['receber'];

$query = "SELECT Email_SubCliente FROM tbl_subcliente WHERE Email_SubCliente = '$email'";
$busca = mysqli_query($conecta,$query);

$query1 = "SELECT Id_evento FROM tbl_subcliente WHERE Id_evento = '$id'";
$buscaid = mysqli_query($conecta,$query1);

echo '<script>
		alert ("Inserido com sucesso!");
		function volta() {
		  window.history.go(-1);
		}
	 </script>';



if(($busca) AND ($busca -> num_rows != 0)){
	if(($buscaid) AND ($buscaid -> num_rows != 0)) {
		$query1 = "UPDATE `tbl_subcliente` SET `Nome_SubCliente`='$nome',`rede_Social`='$rede',`Receber`='$receber' WHERE Email_SubCliente = '".$email."'";
		$alterar = mysqli_query($conecta,$query1);
		echo "<script>
		volta()
		</script>
		";
	}else{
		$query2 ="INSERT INTO `tbl_subcliente`(`Email_SubCliente`, `Nome_SubCliente`, `Id_evento`, `Receber`,`rede_Social`, `DataSub`, `Id_cliente`) VALUES ('$email','$nome','$id','$receber','$data','$rede','".$_SESSION['idc2']."')";
		$inserir = mysqli_query($conecta,$query2);
		echo "<script>
		volta()
		</script>
		";
	}

}else{
	$query3 ="INSERT INTO `tbl_subcliente`(`Email_SubCliente`, `Nome_SubCliente`, `Id_evento`, `Receber`,`rede_Social`, `DataSub`, `Id_cliente`) VALUES ('$email','$nome','$id','$receber','$rede','$data','".$_SESSION['idc2']."')";
	$inserir = mysqli_query($conecta,$query3);
	echo "<script>
	volta()
	</script>
	";
}


//if(($buscadados) AND ($buscadados -> num_rows != 0))




?>
</div>