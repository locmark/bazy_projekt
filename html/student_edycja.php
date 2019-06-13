<html>
    <head>
        <title>dodaj studenta</title>
        <?php include 'scripts/head.php'; ?>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $id = $_GET['id'];

            $query = "SELECT imie, nazwisko, rok_studiow FROM Studenci WHERE id = $id";
            $result = pg_query($query);

            $imie = pg_fetch_result($result,0,0);
            $nazwisko = pg_fetch_result($result,0,1);
            $rok_studiow = pg_fetch_result($result,0,2);

            echo "
                <FORM action=scripts/student_edit_script.php method=POST>
                Edytuj studenta </br>
                <input type=hidden name=id value=$id>
                Imię: <input type=text name=imie value=$imie> </br>
                Nazwisko: <input type=text name=nazwisko value=$nazwisko> </br>
                Rok Studiów: <input type=text name=rok value=$rok_studiow> </br>
                Pokój:
                <select name=pokoj>";

            $query = "SELECT p.id, p.nazwa, a.nazwa FROM Akademiki a, Pokoje p WHERE a.id = p.id_akademika";
            $result = pg_query($query);
            $liczba_wierszy = pg_num_rows($result);


            for($w =0;$w<$liczba_wierszy;$w++)
            {
                echo "<option value=";
                echo pg_fetch_result($result,$w,0);
                echo ">";
                echo pg_fetch_result($result,$w,2);
                echo " - ";
                echo pg_fetch_result($result,$w,1);
                echo "</option>";
            }

            echo "
                </select>
                </br>
                <input type=submit name=Dodaj value=Zapisz> 
                </form>
            ";

            pg_close($connection);
        ?>
    </body>
</html>