<?php 

if(isset($_POST['nazwa']))
{

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password,$db_name);
    
   if ($polaczenie->connect_errno!=0)
    {
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		
		$nazwa = $_POST['nazwa'];
		$cena=$_POST['cena'];
		
			if($polaczenie->query("UPDATE produkty SET cena='$cena' WHERE nazwa='$nazwa'"))
			{
				
	           echo '<span style="color:green">Zaktualizawano produkt: '.$nazwa.'</span>';
		    }
			
		     $polaczenie->close();
	}  	
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>sklep</title>
	
</head>

<body>

<h1> Aktualizacja produktów </h1>

<div id = "container">

<div id = "menu">
	<div class="option"><a href="aktualizuj_nowa_cena.php">Nowa cena</a></div>  
	<div class="option"><a href="aktualizuj_znizka.php">Znizka</a></div> 
	
<br /><a href=index.php>Powrót</a>
</div>


</body>
</html>