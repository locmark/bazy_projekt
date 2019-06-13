<html>
    <head>
        <title>dodaj studenta</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';


            $id_akademika = $_POST['id_akademika'];
            $nazwa = $_POST['nazwa'];
            $pojemnosc = $_POST['pojemnosc'];

            $query = "INSERT INTO Pokoje(id_akademika, nazwa, pojemnosc) VALUES ($id_akademika, '$nazwa', $pojemnosc)";
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
