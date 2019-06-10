<html>
    <head>
        <title>bazy - projekt</title>
    </head>
    <body>
        <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $query = "SELECT * FROM Studenci_pokoje_akademiki";
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

            pg_close($dbh);
        ?>

        <a href="student_add.php">Dodaj Studenta</a>
    </body>
</html>