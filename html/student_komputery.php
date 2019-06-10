<html>
    <head>
        <title>komputery studenta</title>
    </head>
    <body>
        <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $id = $_GET['id'];

            $query = "SELECT host, IP, MAC, data_dodania FROM Komputery WHERE id_studenta = $id";
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
                $host = pg_fetch_result($result,$w,0);
                echo "<TD> <a href=komputer_edycja.php?host=$host>Edycja</a> </TD>";
                echo "<TD> <a href=scripts/komputer_usun_script.php?host=$host>Usuń</a> </TD>";
                echo "</TR>"; //echo "<br />";
            }
            echo "</TABLE>";

            echo "<a href=komputer_dodaj.php?id=$id> Dodaj hosta </a> </br>";

            pg_close($connection);
        ?>
        
        <a href=/bazy> Strona Główna </a>
    </body>
</html>