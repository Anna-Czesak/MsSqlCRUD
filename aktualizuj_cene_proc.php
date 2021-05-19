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

<h1> EDYCJA CENY PRODUKTÓW </h1>

<div id = "container">

<form  method="post">

id produktu, którego cenę chcesz zmienić: <br /><br />

<input type="number" name="id" /><br />

nowa cena: <br /><br />

<input type="number" name="cena" /><br />

<br /><input type="submit" value="sprawdz" /><br /><br />
</form>

<?php 

if ($polaczenie->connect_errno!=0){
		echo "Error: ".$polaczenie->connect_errno;
	}
	else{
		
		$id = $_POST['id'];
		$cena=$_POST['cena'];
		$wynik="call ustaw_cene('$cena','$id')";
		if($polaczenie->query($wynik));
			{
				
	           echo '<span style="color:green">Zaktualizawano cene produktu: '.$id.'</span>';
			
		    }
		
		$polaczenie->close();
						
		}
	
?>

<br /><a href=index.php>Powrót</a>
</div>

</body>
</html>