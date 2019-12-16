<?php 

    session_start();
	//iniciando a sessao
	include_once('../Conexao/conexao.php');	
	//iniciando a conexao com o banco de dados
	$Nome_agenda = $_POST['Nome_agenda'];
	$Inicio_agenda = $_POST['Inicio_agenda'];
	$Final_agenda = $_POST['Final_agenda'];
	$Descricao_agenda  = $_POST['Descricao_agenda'];
	//recebendo os dados do formulario e guardando nas suas variaveis 
	
	$Nome_agenda = trim($Nome_agenda);
	$Inicio_agenda = trim($Inicio_agenda );
	$Final_agenda = trim($Final_agenda);
	$Descricao_agenda = trim($Descricao_agenda);
	
	if ($Nome_agenda == "" || $Inicio_agenda =="" || $Final_agenda==""||$Descricao_agenda==""){
		$_SESSION['vazio'] = true;
		echo" 
	<script>
		 window.history.back();
	</script>
	";
	}else{
	
	//converter as datas para o formato do BD
	$Inicio_agenda = explode(" ", $Inicio_agenda);
	$Final_agenda = explode(" ", $Final_agenda);
	//separando a data da hora 
	
	list($Inicio_agenda, $Inicio_hora) = $Inicio_agenda;
	list($Final_agenda, $Final_hora) = $Final_agenda;
	//guardando a data e a hora em variaveis diferentes
	
	$Inicio_agenda_SB = array_reverse(explode("/", $Inicio_agenda));
	$Inicio_agenda_SB = implode("-",$Inicio_agenda_SB);
	$Final_agenda_SB = array_reverse(explode("/", $Final_agenda));
	$Final_agenda_SB = implode("-",$Final_agenda_SB);
	//separando as partes da data em vetores dd/mm/aaaa para converter pro formato do BD aaa-mm-dd
	
	$Inicio_agenda = $Inicio_agenda_SB." ".$Inicio_hora;
	$Final_agenda = $Final_agenda_SB." ".$Final_hora;
	//concatenando novamente a data com a hora 

	//verifica se a data final é maior que a inicial
	if($Final_agenda < $Inicio_agenda){
		$_SESSION['data'] = true;
		echo "<script>
			location.href='cadastrarAgenda.php';
			</script>";
	}
	else{
    $colocandodados = "INSERT INTO Tbl_agenda (Nome_agenda, Inicio_agenda, Final_agenda, Descricao_agenda, Id_usuario) 
					VALUES ('".$Nome_agenda."',
							'".$Inicio_agenda."',
							'".$Final_agenda."',
							'".$Descricao_agenda."',
							'".$_SESSION['id']."')";
      

     $inserirdados = mysqli_query($conecta, $colocandodados); 
		//inserindo os dados no banco de dados 
		if($inserirdados)
	{$_SESSION['SucessoA'] = true;
		echo "<script>
			location.href='agenda.php';
			</script>";
			
	}
	else 
	{
		$_SESSION['erroA'] = true;
		echo "<script>
			location.href='agenda.php';
			</script>";
	}
	}
    }    
?>