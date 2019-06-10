<html>
    <head>
        <title>dodaj studenta</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $host = $_GET['host'];

            $query = "SELECT MAC, IP FROM Komputery WHERE host = '$host'";
            $result = pg_query($query);

            $MAC = pg_fetch_result($result,0,0);
            $IP = pg_fetch_result($result,0,1);

            echo "
                <FORM action=scripts/komputer_edit_script.php method=POST>
                Edytuj hosta </br>
                <input type=hidden name=host value=$host>
                MAC: <input type=text name=MAC value=$MAC> </br>
                IP: <input type=text name=IP value=$IP> </br>
                <input type=submit name=Dodaj value=Zapisz> 
                </form>
            ";

            echo "<p> historia: </p>";

            $query = "SELECT MAC, IP, data_archiwizacji FROM Komputery_archiwum WHERE host = '$host'";
            $result = pg_query($query);

            $liczba_kolumn = pg_num_fields($result);
            $liczba_wierszy = pg_num_rows($result);
            // teraz wyświetlmy dane
            echo "<TABLE border width=1>";
            echo "<TR>";
            for($k =0;$k<$liczba_kolumn;$k++)
            {
                echo "<TD>";
                echo pg_field_name($result,$k);
                echo "</TD>"; //echo "\t";
            }
            echo "</TR>";

            for($w =0;$w<$liczba_wierszy;$w++)
            {
                echo "<TR>";
                for($k =0;$k<$liczba_kolumn;$k++)
                {
                    echo "<TD>";
                    echo pg_fetch_result($result,$w,$k);
                    echo "</TD>"; //echo "\t";
                }
                echo "</TR>"; //echo "<br />";
            }
            echo "</TABLE>";

            pg_close($connection);
        ?>
    </body>
</html>