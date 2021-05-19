<?php 

if(isset($_POST['nazwa'])){

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password,$db_name);
    
   if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
	
	$id=$_POST['id'];
	$nazwa = $_POST['nazwa'];
	$cena = $_POST['cena'];
	$kolor = $_POST['kolor'];
	$rozmiar = $_POST['rozmiar'];
	$id_kategorii = $_POST['id_kategorii'];
	$dostepnosc = $_POST['dostepnosc'];
	
	
	
$sql = "INSERT INTO produkty VALUES ('$id','$nazwa','$cena','$kolor','$rozmiar','$id_kategorii','$dostepnosc')";
$polaczenie->query($sql);

echo '<span style="color:green"> Dodano produkt! </span>';	
	}

	$polaczenie->close();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sklep</title>
	
</head>

<body>

<h1> Dodaj do bazy produktow </h1>

<div id = "container">

<form  method="post">
DANE OSOBISTE <br /><br />

id produktu:<br />
<input type="text" name="id" /><br />

nazwa:<br />
<input type="text" name="nazwa" /><br />

cena:<br />
<input type="text" name="cena" /><br />

kolor:<br />
<input type="text" name="kolor" /><br />

rozmiar:<br />
<input type="numer" name="rozmiar" /><br />

kategoria:<br />
<input type="text" name="id_kategorii" /><br />

dostepnosc:<br />
<input type="text" name="dostepnosc" /><br />

<br /><input type="submit" value="dodaj" />
</form>

<br /><a href=index.php>Powrót</a>


</div>


</body>
</html>