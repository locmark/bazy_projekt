<html>
    <head>
        <title>bazy - projekt</title>
    </head>
    <body>
        <div>
            <h3>Studenci</h3>
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
                for($k =1;$k<$liczba_kolumn;$k++)
                {
                    echo "<TD>";
                    echo pg_field_name($result,$k);
                    echo "</TD>"; //echo "\t";
                }
                echo "</TR>";

                for($w =0;$w<$liczba_wierszy;$w++)
                {
                    echo "<TR>";
                    for($k =1;$k<$liczba_kolumn;$k++)
                    {
                        echo "<TD>";
                        echo pg_fetch_result($result,$w,$k);
                        echo "</TD>"; //echo "\t";
                    }
                    $id = pg_fetch_result($result,$w,0);
                    echo "<TD> <a href=student_komputery.php?id=$id>Komputery</a> </TD>";
                    echo "<TD> <a href=student_edycja.php?id=$id>Edycja</a> </TD>";
                    echo "<TD> <a href=scripts/student_usun_script.php?id=$id>Usuń</a> </TD>";
                    echo "</TR>"; //echo "<br />";
                }
                echo "</TABLE>";

                pg_close($connection);
            ?>

            <a href="student_add.php">Dodaj Studenta</a>

        </div>

        <div>
            <h3>Pracownicy</h3>
            <?php 
                include 'scripts/show_errors.php';
                include 'scripts/db_connect.php';

                $query = "SELECT p.id, p.imie, p.nazwisko, z.nazwa AS Zawod FROM Pracownicy p, Zawody z WHERE p.id_zawodu = z.id";
                $result = pg_query($query);

                $liczba_kolumn = pg_num_fields($result);
                $liczba_wierszy = pg_num_rows($result);
                // teraz wyświetlmy dane
                echo "<TABLE border width=1>";
                echo "<TR>";
                for($k =1;$k<$liczba_kolumn;$k++)
                {
                    echo "<TD>";
                    echo pg_field_name($result,$k);
                    echo "</TD>"; //echo "\t";
                }
                echo "</TR>";

                for($w =0;$w<$liczba_wierszy;$w++)
                {
                    echo "<TR>";
                    for($k =1;$k<$liczba_kolumn;$k++)
                    {
                        echo "<TD>";
                        echo pg_fetch_result($result,$w,$k);
                        echo "</TD>"; //echo "\t";
                    }
                    $id = pg_fetch_result($result,$w,0);
                    echo "<TD> <a href=pracownik_edycja.php?id=$id>Edycja</a> </TD>";
                    echo "<TD> <a href=scripts/pracownik_usun_script.php?id=$id>Usuń</a> </TD>";
                    echo "</TR>"; //echo "<br />";
                }
                echo "</TABLE>";

                pg_close($connection);
            ?>

            <a href="student_add.php">Dodaj Pracownika</a>

        </div>
    </body>
</html>