<html>
    <head>
        <title>dodaj studenta</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            echo "
                <FORM action=student_add2.php method=POST>
                Dodaj nowego studenta </br>
                Imię: <input type=text name=imie> </br>
                Nazwisko: <input type=text name=nazwisko> </br>
                Rok Studiów: <input type=text name=rok> </br>
                Akademik:
                <select name=akademik>";

            $query = "SELECT id, nazwa FROM Akademiki";
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
                <input type=submit name=Dodaj value=Dalej> 
                </form>
            ";

            pg_close($dbh);
        ?>
    </body>
</html>