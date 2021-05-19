<?php 

if(isset($_POST['id_produktu']))
{

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password,$db_name);
    
   if ($polaczenie->connect_errno!=0)
    {
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		
		$id_produktu= $_POST['id_produktu'];
		$promocja=(100-$_POST['znizka']);
		
		  echo '<span style="color:green">Zaktualizawano produkt: '.$id_produktu.'</span>';
		  
			if($polaczenie->query("UPDATE produkty SET cena=cena*$promocja/100 WHERE id='$id_produktu'"));
			{
	         
			
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

<h1>Obniż cene produktu</h1>

<div id = "container">

<form  method="post">

Ustaw wielkość zniżki [%]:<br />
<input type="number" name="znizka" /><br /><br />

Id produktu podlegającego zniżce:<br />
<input type="number" name="id_produktu" /><br />


<br /><input type="submit" value="aktualizuj" />

</form>


<br /><a href=widok_produkty.php>Zobacz aktualne ceny</a>

<br /><a href=index.php>Powrót</a>
</div>


</body>
</html>