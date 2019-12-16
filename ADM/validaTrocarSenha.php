<?php
include_once('../Conexao/conexao.php');
$senha = $_POST['senha'];
$Csenha = $_POST['Csenha'];
$senhaA = $_POST['senhaA'];
session_start();

$query = "SELECT Senha_usuario from Tbl_usuarios WHERE Id_usuario = '".$_SESSION['id']."'";
$buscaSenha = mysqli_query($conecta,$query);
$senhaAntiga = mysqli_fetch_assoc($buscaSenha);

if(password_verify($senhaA, $senhaAntiga['Senha_usuario'])){
	if($senha == $Csenha){
	$senha = password_hash($senha, PASSWORD_DEFAULT);
	$query = "UPDATE `tbl_usuarios` SET `Senha_usuario`='$senha' WHERE Id_usuario ='".$_SESSION['id']."'";
	$envia = mysqli_query($conecta,$query);
	$_SESSION['alte'] = true;
	?>
	<script>
	
	location.href='../ADM/vizualizaUsuario.php';
	
	
	</script>
		<?php
	}else{
		$_SESSION['diferente'] = true;
		?>
		<script>
		location.href='trocarSenha.php';
		</script>
		<?php
	}
}else{
	$_SESSION['senhaA'] = true;
	?>
		<script>
		location.href='trocarSenha.php';
		</script>
		<?php
}
?>
