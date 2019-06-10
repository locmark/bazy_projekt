<html>
    <head>
        <title>dodaj studenta</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $rok = $_POST['rok'];
            $pokoj = $_POST['pokoj'];

            $query = "INSERT INTO Studenci(imie, nazwisko, rok_studiow, id_pokoju) VALUES ('$imie', '$nazwisko', $rok, $pokoj)";
            $result = pg_query($query);
            $amount_of_added = pg_affected_rows($result); 
            
            if(amount_of_added != 0)
            {
                echo "<b>powodzenie :D</b> </br>";
            }
            else
            {
                echo "<b>niepowodzenie :(</b> </br>";
                echo $query;
                echo $result;
                echo $amount_of_added;
            }
            

            echo "<a href=/bazy> Strona Główna </a>";


            pg_close($dbh);
        ?>
    </body>
</html>