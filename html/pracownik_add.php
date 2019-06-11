<html>
    <head>
        <title>dodaj pracownika</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            echo "
                <FORM action=scripts/pracownik_add_script.php method=POST>
                Dodaj nowego pracownika </br>
                Imię: <input type=text name=imie> </br>
                Nazwisko: <input type=text name=nazwisko> </br>
                Stanowisko:
                <select name=id_zawodu>";

            $query = "SELECT id, nazwa FROM Zawody";
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
                </br>
                <input type=submit name=Dodaj value=Dodaj> 
                </form>
            ";

            pg_close($connection);
        ?>
    </body>
</html>