<?php
include_once('../Conexao/conexao.php');
$senha = $_POST['senha'];
$Csenha = $_POST['Csenha'];
session_start();

if($senha == $Csenha){
	$senha = password_hash($senha, PASSWORD_DEFAULT);
	$query = "UPDATE `tbl_usuarios` SET `Senha_usuario`='$senha' WHERE Email_usuario ='".$_SESSION['email']."'";
	$envia = mysqli_query($conecta,$query);
	?>
	<script>
	alert("Senha alterada com sucesso");
	location.href='../Login/login.php';
	</script>
	<?php
}else{
	$_SESSION['senhaD'] = true;
	?>
	<script>
	location.href='trocarSenha.php';
	</script>
	<?php
}
?>