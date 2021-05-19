<?php 
require_once  "connect.php";
$polaczenie = new mysqli($host, $db_user, $db_password,$db_name);
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sklep</title>
	
</head>

<body>

<h1> SKLEP Z UBRANIAMI BAZA DANYCH </h1>

<div id = "container">

<div id = "menu">
	<div class="option"><a href="wyswietl_klientow.php">Wyświetl bazę klientow</a></div>  
	<div class="option"><a href="wyswietl_produkty.php">Wyświetl bazę produktów</a></div> 
	<div class="option"><a href="wyswietl_zamowienia.php">Wyświetl bazę zamówień</a></div>
	
	<div style="clear:both"></div>
	</div>
<br /><a href=index.php>Powrót</a>
</div>

</body>
</html>