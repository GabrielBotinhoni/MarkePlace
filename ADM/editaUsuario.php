<!DOCTYPE html>
<?php
	include_once('../Seguranca/seguro.php');
	include_once('../Conexao/conexao.php');	
	$consulta= "SELECT * FROM tbl_usuarios WHERE Id_usuario = '".$_SESSION['id']."' LIMIT 1";	
	$busca = mysqli_query($conecta, $consulta);
	//executando a consulta no BD
	$resultado = mysqli_fetch_assoc($busca);
	// jogando os dados da consulta dentro de um vetor
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>
	<meta charset='UTF-8'>
	<title>Editar usuário</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloEditaUsuario.css"/>
	<link rel = "stylesheet" type = "text/css" href = "../css/estiloEditaUsuarioMob.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenu.css"/>

	<link rel = "stylesheet" type = "text/css" href = "../css/estiloMenuMob.css"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
		function confirmSair() {
		   if (confirm("Tem certeza que deseja sair?")) {
		      location.href="../Login/sair.php";
		   }
		}

        function verificar(){

            var texto=document.getElementById("nome").value;

            for (letra of texto){

                if (!isNaN(texto)){

                    alert("Não digite números");
                    document.getElementById("nome").value="";
                    return;
                }

                letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"

                var ok = false;
                for (letra2 of letraspermitidas ){

                    if (letra==letra2){

                        ok=true;
                    }

                 }

                 if (!ok){
                    alert("Não digite caracteres que não sejam letras ou espaços no campo!");
                    document.getElementById("nome").value="";
                    return; 
                 }
            }
        }
	 </script>

	 <script>
		$(document).ready(function(){
			$('.botao').click(function(){
				$('.menuList li, .quadroTransp').slideToggle();
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#userFoto').click(function(){
				$('#userConfig').slideToggle();
			});
			});
	</script>
	<script src="../js/jquery.min.js"></script>
</head>
<body>

	<div id = "menu">
		<div id="content">
			<div class = "linkCentro">	
				
				<!--Aqui vira todos os links de ADM-->	
				<a href='../ADM/index.php' id = "areaAdministração">Area de administração</a>
				<a href='../Agenda/agenda.php' id = "agenda">Agenda</a>  
				<a href='../ADM/cadastroCliente.php' id = "cadastroCliente">Cadastrar Cliente</a> 
				<a href='../ADM/listaCliente.php' id = "listaCliente">Clientes Cadastrados</a> 

			</div>

			<?php 
				$query = "SELECT  `Icon_usuario` FROM `tbl_usuarios` WHERE Id_usuario = '".$_SESSION['id']."'";
				$pesquisaImg = mysqli_query($conecta,$query);
				$resultadoImg = mysqli_fetch_assoc($pesquisaImg);
				?>

				<div id = "userFoto">
				<?php
					if($resultadoImg['Icon_usuario'] != 'placeholder.png'){
						echo '<img src = "../img/iconUsu/'.$resultadoImg["Icon_usuario"].'" id = "BdUserImg">';
					} else{?>
						<img src = "../img/iconUsu/placeholder.png">
				<?php }?>
				</div>

				<div id = "userConfig">
				
				
				<?php

				if($resultadoImg['Icon_usuario'] != 'placeholder.png'){
					echo '<img src = "../img/iconUsu/'.$resultadoImg["Icon_usuario"].'"  id = "BdUserImgPlaceholder">';
					
				} else{?>
					<img src = "../img/iconUsu/placeholder.png">
				<?php }?>
				
				<p>	
					Conectado com<br>
					<b><?php echo $_SESSION['nome']?></b>
				</p>

				<a href = "vizualizaUsuario.php">
					<p>
						<button>Vizualizar minhas informações</button>
					</p>
				</a>

				<p><input type = "submit" value = "Sair" onclick="confirmSair()"/></p>
			</div>


		</div>

		<div id = "menuMob">
			<div class = "botao">
				<img src = "../img/logo/menuIcon.png">
			</div>

			<div class = "quadroTransp"></div>

			<div class = "menuList">
				<ul>
					<a href='index.php' class = "link"><li>Area de administração</li></a>
					<a href='cadastroCliente.php' class = "link"><li>Cadastrar Cliente</li></a>
					<a href='listaCliente.php' class = "link"><li>Clientes Cadastrados</li></a>
					<a href='../Agenda/agenda.php' class = "link"><li>Agenda</li></a>
					
					<li><input type = "submit" value = "Sair" onclick="confirmSair()"/></li>
				</ul>
			</div>

		</div>
	</div>
	<a href = "javascript:history.back(-1)"><div id = "back"></div></a>

	<div id="quadro"></div>

	<div id = "contentAll">
		
		<h2>Editar usuário</h2>
		<img src = "../img/user/edit.png">
		<?php 
					if(isset($_SESSION['emailC'])):
				?>
				
					<div id = "msgContent">
						<p>email já cadastrado!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['emailC']);
		?>
		<?php 
					if(isset($_SESSION['suc'])):
				?>
				
					<div id = "msgContent">
						<p>editado com sucesso!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['suc']);
		?>
		<?php 
					if(isset($_SESSION['erro'])):
				?>
				
					<div id = "msgContent">
						<p>Erro ao editar!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['erro']);
		?>
		<?php 
					if(isset($_SESSION['vazio'])):
				?>
				
					<div id = "msgContent">
						<p>Digite todos os campos!</p>
					</div>

				<?php 
					endif;
					unset($_SESSION['vazio']);
		?>

		<form method = "post" action = "validaEditaUsuario.php" >
			<table>
				<tr>
					<td>
						Nome:
					</td>
					<td><input type='text' name='nomeUsuario' id='nome' onchange="verificar()" value='<?php echo $resultado['Nome_usuario'] ?>' required/>
					</td>
				</tr>
				<tr>
					<td>
						E-mail:
					</td>
					<td>
						<input type="email" name="emailUsuario" id="emailSubClit"  value = "<?php echo $resultado['Email_usuario']?>" required>
					</td>
				</tr>
			</table>

			<center><input type="submit"></center>

		</form>
	</div>
</body>
</html>