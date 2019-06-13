<html>
    <head>
        <title>dodaj studenta</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
    <?php 
            include 'show_errors.php';
            include 'db_connect.php';

            $host = $_POST['host'];
            $IP = $_POST['IP'];
            $MAC = $_POST['MAC'];

            $query = "UPDATE Komputery SET IP = '$IP', MAC = '$MAC' WHERE host = '$host'";
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