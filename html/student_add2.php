<html>
    <head>
        <title>dodaj studenta</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $rok = $_POST['rok'];
            $akademik = $_POST['akademik'];

            echo "
                <FORM action=scripts/student_add_script.php method=POST>
                Dodaj nowego studenta </br>
                <input type=hidden name=imie value=$imie>
                <input type=hidden name=nazwisko value=$nazwisko>
                <input type=hidden name=rok value=$rok>
                <input type=hidden name=akademik value=$akademik>
                Pokój:
                <select name=pokoj>";

            $query = "SELECT id, nazwa FROM Pokoje WHERE id_akademika = $akademik";
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

            pg_close($dbh);
        ?>
    </body>
</html>