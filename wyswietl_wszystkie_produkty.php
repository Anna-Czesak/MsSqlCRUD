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

<h1> BAZA PRODUKTÓW </h1>

<div id = "container">

<?php 

if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		$wynik="SELECT id, nazwa, cena, kolor, rozmiar, id_kategorii, dostepnosc FROM produkty UNION SELECT id, nazwa, cena, kolor, rozmiar, id_kategorii, dostepnosc FROM nowa_kolekcja_produktów";
		
	 if($results = @$polaczenie->query($wynik)){
			echo "<table>"; 
		//echo "<td>"."<b>ID UBRANIA</b>"."</td>";
		echo "<td>"."<b>NAZWA</b>"."</td>";
		echo "<td>"."<b>CENA</b>"."</td>";
		echo "<td>"."<b>KOLOR</b>"."</td>";
		echo "<td>"."<b>ROZMIAR</b>"."</td>";
		//echo "<td>"."<b>KATEGORIA</b>"."</td>";
		echo "<td>"."<b>DOSTEPNOŚĆ</b>"."</td>";
			
        while($row=mysqli_fetch_assoc($results)){
		echo "<tr>"; 
		//echo "<td>".$row['id']."</td>";
		echo "<td>".$row['nazwa']."</td>"; 
		echo "<td>".$row['cena']."</td>"; 
		echo "<td>".$row['kolor']."</td>"; 
		echo "<td>".$row['rozmiar']."</td>";
		//echo "<td>".$row['kategoria']."</td>";
		echo "<td>".$row['dostepnosc']."</td>";
		echo "</tr>"; 
		}
		echo "</table>"; 
		
		$polaczenie->close();
						
		}
	}
?>

<br /><a href=index.php>Powrót</a>
</div>

</body>
</html>