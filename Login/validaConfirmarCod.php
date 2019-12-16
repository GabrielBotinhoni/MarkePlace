<?php
	session_start();

	$codigo = $_POST['Ccodigo'];
	
	if($_SESSION['senha'] == $codigo){
		?>
		<script>
		location.href = '../Login/trocarSenha.php';
		</script>
		<?php
	}else{
		$_SESSION['cod'] = true;
		?>
		<script>
			location.href='../Login/confirmarCodigo.php';
		</script>
		<?php
	}

?>