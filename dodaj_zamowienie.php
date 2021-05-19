<?php 

if(isset($_POST['id_klienta'])){

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password,$db_name);
    
   if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
	
	$id=$_POST['id'];
	$id_klienta=$_POST['id_klienta'];
	$id_produktu=$_POST['id_produktu'];
	$ilosc=$_POST['ilosc'];

	
	$sql = "SELECT dostepnosc FROM produkty WHERE id=$id_produktu";
	$dostepnosc=$polaczenie->query($sql);
	$row=mysqli_fetch_assoc($dostepnosc);
	if($row['dostepnosc']<$ilosc){
		echo 'Brak produktu w magazynie';
	}else{
	
	
		
		
		
		
$sql = "INSERT INTO `zamowienia`(`id`, `id_klienta`, `id_produktu`, `ilosc`) VALUES ('$id','$id_klienta','$id_produktu','$ilosc')";
$polaczenie->query($sql);

echo '<span style="color:green"> Dodano zamowienie! </span>';	

if($polaczenie->query("UPDATE produkty SET dostepnosc=dostepnosc-$ilosc WHERE id=$id_produktu"));
			{
				
	           echo '<span style="color:green">Zaktualizawano dostepnosc produkt: '.$id_produktu.'</span>';
			
		    }
	}

	$polaczenie->close();}
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

<h1> Dodaj do zamówień </h1>

<div id = "container">

<form  method="post">

id zamowienia:<br />
<input type="numer" name="id" /><br />

id klienta:<br />
<input type="numer" name="id_klienta" /><br />

id produktu:<br />
<input type="numer" name="id_produktu" /><br />

ilosc:<br />
<input type="numer" name="ilosc" /><br />

<br /><input type="submit" value="dodaj" />
</form>

<br /><a href=index.php>Powrót</a>

</div>


</body>
</html>