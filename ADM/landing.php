	<!DOCTYPE html>
<?php
	session_start();
	
	include_once('../Conexao/conexao.php');	
	
	$_SESSION['idE']  = $_GET['id'];
	
	$id = $_GET['id'];
	
	date_default_timezone_set('America/Sao_Paulo');

	$data = date ('Y-m-d');
	
	$ace = 1;
	
	$query="SELECT `Id_cliente` FROM `tbl_eventos` WHERE Id_evento = $id";
	$idct = mysqli_query($conecta,$query);
	$idc = mysqli_fetch_assoc ($idct);
	$_SESSION['idc2'] = $idc['Id_cliente'];
	
	
	$contar = "SELECT * FROM tbl_subcliente WHERE DataSub ='$data' and Receber = 1";
	$contarbus = mysqli_query($conecta,$contar);
	
	$numcon = $contarbus -> num_rows;
	
	if ($numcon==""){
		$rece =0;
	}else{
		$rece = $numcon;
	}
	
	
	
	$querybus = "SELECT * FROM tbl_estatisticas WHERE DataEst = '$data' and Id_evento = '$id'";
	$busca = mysqli_query($conecta,$querybus);
	
	if(($busca) AND ($busca -> num_rows != 0)){
		$query = "UPDATE `tbl_estatisticas` SET `Acessos`=`Acessos`+1,`Enviar`= '$rece' WHERE DataEst = '$data' and Id_evento = '$id'";
		$envia = mysqli_query($conecta,$query);
	}else{
		$query = "INSERT INTO tbl_estatisticas (Id_evento, DataEst,Acessos,Enviar,Id_cliente) VALUES ('$id','$data','ace','$rece','".$idc['Id_cliente']."')";
		$envia = mysqli_query($conecta,$query);
	}
	

?>
<html>
	<head>
	<link rel="shortcut icon" href="../img/logo/iconLogo.jpg"/>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset = "UTF-8">
	<title>Landing Page</title>
	<link rel="stylesheet" type="text/css" href="../css/estiloLanding.css">
	<link rel="stylesheet" type="text/css" href="../css/estiloLandingMob.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"><!--Fonte do Google-->

	<script>
        function verificarNome(){

            var texto=document.getElementById("nomeSubClit").value;

            for (letra of texto){

                if (!isNaN(texto)){

                    alert("Não digite números");
                    document.getElementById("nomeSubClit").value="";
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
                    document.getElementById("nomeSubClit").value="";
                    return; 
                 }
            }
        }

        function muda_cor(selecionado){
			if(selecionado=="Twitter"){
				document["formEstilo"].redeSocial.style.background = "#1da1f2";
			}
			else if(selecionado=="Selecione"){
				document["formEstilo"].redeSocial.style.background = "#1C1C1C";
			}
			else if(selecionado=="Outros"){
				document["formEstilo"].redeSocial.style.background = "#1C1C1C";
			}
			else if(selecionado=="Instagram"){
				document["formEstilo"].redeSocial.style.background = "url('../img/LandingBack/instagramGradient.jpg')";
			}else if(selecionado=="Facebook"){
				document["formEstilo"].redeSocial.style.background = "#3b5998";
			}

		}

	</script>
	</head>
	
	<body>
		<div id = "leftContent">
			<img src = "../img/logo/logo.png">
			<p>Entendendo as necessidades do profissional de marketing e o ajudando a<br> 
			 	execultar trabalhos práticos de forma simples.</p>

			<img src = "../img/adm/landingImg.png" id = "graphics">
		</div>

		<div class = "quadro"></div>
		<div class = "contentLanding">
			<center>
				<h2>Landing Page</h2>

				<form method = "post" action = "processaLanding.php" name = "formEstilo">
				<table>	
					<tr>	
						<td>Nome:</td><td><input type="text" name="nomeSubClit" id="nomeSubClit" required onchange="verificarNome()"></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="email" name="emailSubClit" id="emailSubClit" required></td>
					</tr>
					<tr>
						<td>De onde você veio:</td><td><select name = "redeSocial" onchange="muda_cor(this.value);">
									<option selected class = "op">Selecione</option>
									<option class = "op">Twitter</option>
									<option class = "op">Instagram</option>
									<option class = "op">Facebook</option>
									<option class = "op">Outros</option>
									</select>
									</td>
					</tr>
				</table>
				
				<div class = "btns">
					<input type="hidden" name="receber" value="0">
						
						<label class="container">
							<input type="checkbox" name="receber" value="1" id = "checkStyle"> 
							<span class="checkmark"></span>
							Eu gostaria de receber informações dos<br> proximos eventos<br>
						</label>

					<input type="submit">
				</div>

				</form>
			</center>			
		</div>
		
	</body>
</html>