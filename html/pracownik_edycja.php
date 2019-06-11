<html>
    <head>
        <title>edytuj pracownika</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $id = $_GET['id'];

            $query = "SELECT imie, nazwisko, id_zawodu FROM Pracownicy  WHERE id = $id";
            $result = pg_query($query);

            $imie = pg_fetch_result($result,0,0);
            $nazwisko = pg_fetch_result($result,0,1);
            $id_zawodu = pg_fetch_result($result,0,2);

            echo "
                <FORM action=scripts/pracownik_edit_script.php method=POST>
                Edytuj pracownika </br>
                <input type=hidden name=id value=$id>
                Imię: <input type=text name=imie value=$imie> </br>
                Nazwisko: <input type=text name=nazwisko value=$nazwisko> </br>
                Stanowisko:
                <select name=id_zawodu>";

            $query = "SELECT id, nazwa FROM Zawody";
            $result = pg_query($query);
            $liczba_wierszy = pg_num_rows($result);


            for($w =0;$w<$liczba_wierszy;$w++)
            {
                echo "<option value=";
                echo pg_fetch_result($result,$w,0);
                if (pg_fetch_result($result,$w,0) == $id_zawodu) {
                    echo " selected";
                }
                echo ">";
                echo pg_fetch_result($result,$w,1);
                echo "</option>";
            }

            echo "
                </select>
                </br>
                <input type=submit name=Dodaj value=Zapisz> 
                </form>
            ";

            // 
            // aktualne akademiki
            // 

            echo "<h3>obsługiwane akademiki</h3>";

            $query = "SELECT pa.id_akademika, a.nazwa FROM Pracownicy_akademika pa, Akademiki a WHERE pa.id_akademika = a.id AND id_pracownika = $id";
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
                $id_akademika = pg_fetch_result($result,$w,0);
                echo "<TD> <a href=scripts/pracownik_akademika_usun_script.php?id_pracownika=$id&id_akademika=$id_akademika>Usuń</a> </TD>";
                echo "</TR>"; //echo "<br />";
            }
            echo "</TABLE>";

            // 
            // dodaj akademik
            // 

            echo "
                <FORM action=scripts/pracownik_akademika_add_script.php method=POST>
                <input type=hidden name=id_pracownika value=$id>
                <input type=submit name=Dodaj value='Dodaj obsługiwany akademik'> 
                <select name=id_akademika>";

            $query = "SELECT a.id, a.nazwa FROM Pracownicy_akademika pa RIGHT JOIN Akademiki a ON pa.id_pracownika = $id AND pa.id_akademika = a.id WHERE pa.id_akademika is NULL";
            $result = pg_query($query);
            $liczba_wierszy = pg_num_rows($result);


            for($w =0;$w<$liczba_wierszy;$w++)
            {
                echo "<option value=";
                echo pg_fetch_result($result,$w,0);
                echo ">";
                echo pg_fetch_result($result,$w,1);
                echo "</option>";
            }

            echo "
                </select>
                </form>
            ";




            pg_close($connection);
        ?>
    </body>
</html>