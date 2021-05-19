<?php 

if(isset($_POST['imie'])){

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password,$db_name);
    
   if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		
	// odbieramy dane z formularza
	
	$id=$_POST['id'];
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$email = $_POST['email'];
	$nr = $_POST['nr'];
	$ulica = $_POST['ulica'];
	$dom_lokal = $_POST['dom_lokal'];
	$miasto = $_POST['miasto'];	
	
$sql = "INSERT INTO adresy (id, ulica, dom_lokal, miasto) VALUES ('$id','$ulica','$dom_lokal','$miasto')";
$polaczenie->query($sql);
	
$sql="INSERT INTO `klienci`(`id`, `imie`, `nazwisko`, `nr_telefonu`, `mail`, `id_adresu`) VALUES ('$id','$imie','$nazwisko','$nr','$email',(SELECT id FROM adresy WHERE id = $id))";
$polaczenie->query($sql);

echo '<span style="color:green"> Dodano klienta! </span>';	
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

<h1> Dodaj do bazy klientow </h1>

<div id = "container">

<form  method="post">
DANE OSOBISTE <br /><br />

id klienta:<br />
<input type="numer" name="id" /><br />

imię:<br />
<input type="text" name="imie" /><br />

nazwisko:<br />
<input type="text" name="nazwisko" /><br />

e-mail:<br />
<input type="text" name="email" /><br />

numer telefonu:<br />
<input type="numer" name="nr" /><br />

<br />ADRES<br /><br />

ulica:<br />
<input type="text" name="ulica" /><br />

dom/lokal:<br />
<input type="text" name="dom_lokal" /><br />

miasto:<br />
<input type="text" name="miasto" /><br />

<br /><input type="submit" value="dodaj" />
</form>

<br /><a href=index.php>Powrót</a>

</div>


</body>
</html>