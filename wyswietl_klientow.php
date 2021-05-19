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

<h1> BAZA KLIENTÓW </h1>

<div id = "container">

<?php 

if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		$wynik="SELECT * FROM widok_klient_adres";
		
	 if($results = @$polaczenie->query($wynik)){
			echo "<table>"; 
		echo "<td>"."<b>ID</b>"."</td>";
		echo "<td>"."<b>IMIĘ</b>"."</td>";
		echo "<td>"."<b>NAZWISKO</b>"."</td>";
		echo "<td>"."<b>TELEFON</b>"."</td>";
		echo "<td>"."<b>EMAIL</b>"."</td>";
		echo "<td>"."<b>ULICA</b>"."</td>";
		echo "<td>"."<b>DOM/LOKAL</b>"."</td>";
		echo "<td>"."<b>MIASTO</b>"."</td>";
		echo "<td>"."<b></b>"."</td>";
			
        while($row=mysqli_fetch_assoc($results)){
		echo "<tr>"; 
		echo "<td>".$row['id_adresu']."</td>"; 
		echo "<td>".$row['imie']."</td>";
		echo "<td>".$row['nazwisko']."</td>"; 
		echo "<td>".$row['nr_telefonu']."</td>"; 
		echo "<td>".$row['mail']."</td>";  
		echo "<td>".$row['ulica']."</td>";
		echo "<td>".$row['dom_lokal']."</td>";
		echo "<td>".$row['miasto']."</td>";
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