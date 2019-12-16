<?php
session_start ();

unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['nivel_acesso'])  ;

$_SESSION['msgDeslog'] = true;//mensagem de "deslogado com sucesso!"

header("Location: login.php");

?>