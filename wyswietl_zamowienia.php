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

<h1> BAZA ZAMÓWIEŃ </h1>

<div id = "container">

<?php 

if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		
		$wynik="SELECT * FROM produkty INNER JOIN zamowienia ON produkty.id=zamowienia.id_produktu ";
		
		@$polaczenie->query($wynik);

	 if($results = @$polaczenie->query($wynik)){
			echo "<table>"; 
		echo "<td>"."<b>NR </b>"."</td>";
		echo "<td>"."<b>KLIENT</b>"."</td>";
		echo "<td>"."<b>PRODUKTU</b>"."</td>";
		echo "<td>"."<b>ILOSC</b>"."</td>";
		
			
        while($row=mysqli_fetch_assoc($results)){
		echo "<tr>"; 
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['id_klienta']."</td>"; 
		echo "<td>".$row['nazwa']."</td>"; 
		echo "<td>".$row['ilosc']."</td>"; 
		
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