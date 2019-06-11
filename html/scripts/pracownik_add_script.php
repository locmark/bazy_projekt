<html>
    <head>
        <title>dodaj studenta</title>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $id_zawodu = $_POST['id_zawodu'];

            $query = "INSERT INTO Pracownicy(imie, nazwisko, id_zawodu) VALUES ('$imie', '$nazwisko', $id_zawodu)";
            $result = pg_query($query);
            $amount_of_added = pg_affected_rows($result); 
            
            if($amount_of_added != 0)
            {
                echo "<b>powodzenie :D</b> </br>";
            }
            else
            {
                echo "<b>niepowodzenie :(</b> </br>";
            }
            

            echo "<a href=/bazy> Strona Główna </a>";


            pg_close($connection);
        ?>
    </body>
</html>