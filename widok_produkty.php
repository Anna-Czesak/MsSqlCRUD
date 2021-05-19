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

<h1> Aktualne ceny produktów </h1>

<div id = "container">

<?php 
if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		
		$wynik="SELECT * FROM widok_produkt_cena ";
		
	
		@$polaczenie->query($wynik);
		

		
		
	 if($results = @$polaczenie->query($wynik)){
			echo "<table>"; 
		echo "<td>"."<b>nazwa </b>"."</td>";
		echo "<td>"."<b>cena</b>"."</td>";
			
        while($row=mysqli_fetch_assoc($results)){
		echo "<tr>"; 
		echo "<td>".$row['nazwa']."</td>";
		echo "<td>".$row['cena']."</td>"; 
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