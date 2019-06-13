<html>
    <head>
        <title>usuń studenta</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';

            $id_akademika = $_GET['id_akademika'];
            $id_pracownika = $_GET['id_pracownika'];

            $query = "DELETE FROM Pracownicy_akademika WHERE id_akademika = $id_akademika AND id_pracownika = $id_pracownika";
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
            

            include 'homepage.php';


            pg_close($connection);
        ?>
    </body>
</html>
