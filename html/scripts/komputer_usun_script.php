<html>
    <head>
        <title>usuń komputer</title>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';

            $host = $_GET['host'];

            $query = "DELETE FROM Komputery WHERE host = '$host'";
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