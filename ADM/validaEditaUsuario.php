<?php
$nome = trim($_POST['nomeUsuario']);
$email = trim($_POST['emailUsuario']);

include_once('../Seguranca/seguro.php');
include_once('../Conexao/conexao.php');	

$query = "SELECT Email_usuario FROM tbl_usuarios WHERE Id_usuario = ".$_SESSION['id']."";
$pegaemail = mysqli_query($conecta,$query);
$emailC = mysqli_fetch_assoc($pegaemail);

if($nome == "" || $email ==""){
	$_SESSION['vazio'] = true;
	echo" 
	<script>
		 window.history.back();
	</script>
	";
}else{
	if($email != $emailC['Email_usuario']){
		$query = "SELECT Email_usuario FROM tbl_usuarios WHERE Email_usuario = '$email'";
		$pegaemail = mysqli_query($conecta,$query);
		
		if (($pegaemail) && ($pegaemail -> num_rows !=0)){
			$_SESSION['emailC']= true;
			echo" 
		<script>
			 window.history.back();
		</script>
		";
		exit;
		}
		else{
			
			$query = "UPDATE `tbl_usuarios` SET `Nome_usuario`='$nome',`Email_usuario`='$email' WHERE Id_usuario = ".$_SESSION['id']."";
			$insere = mysqli_query($conecta,$query);
			
			if($insere){
				$_SESSION['suc']= true;
				echo "<script>
					location.href='../ADM/editaUsuario.php';
					</script>";
			}else{
				$_SESSION['erro']= true;
				echo "<script>
					location.href='../ADM/editaUsuario.php';
					</script>";
			}
		}	
	}
	
	$query = "UPDATE `tbl_usuarios` SET `Nome_usuario`='$nome',`Email_usuario`='$email' WHERE Id_usuario = ".$_SESSION['id']."";
	$insere = mysqli_query($conecta,$query);
	
	if($insere){
		$_SESSION['suc']= true;
		echo "<script>
			location.href='../ADM/editaUsuario.php';
			</script>";
	}else{
		$_SESSION['erro']= true;
		echo "<script>
			location.href='../ADM/editaUsuario.php';
			</script>";
	}
}
?>