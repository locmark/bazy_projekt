<html>
    <head>
        <title>dodaj studenta</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';

            $id = $_POST['id'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $rok = $_POST['rok'];
            $pokoj = $_POST['pokoj'];

            $query = "UPDATE Studenci SET imie = '$imie', nazwisko = '$nazwisko', rok_studiow = $rok, id_pokoju = $pokoj WHERE id = $id";
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