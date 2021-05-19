<?php
    if (isset($_POST['id']))
	{
        require_once "connect.php";
        $connection=@new mysqli($host, $db_user, $db_password, $db_name);

        if ($connection->connect_errno!=0){
            echo "Error ";
        }
        else{

            $id=$_POST['id'];
            if ($connection->query("DELETE FROM produkty WHERE id='$id'"));
			{
				echo '<span style="color:red"> Usunięto produkt: '.$id.'</span>';
			}
			

            $connection->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <title>Sklep</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
        
    </head>

    <body>
       <h1> Usuń produkt z bazy danych </h1>
       <main class="container">

            <form method="post">

                id_produktu:
                <input type="number" name="id">
               <input type="submit" value="delete" />
            </form>
          <br /><a href=index.php>Powrót</a>
       </main>

    
       
    </body>
</html>