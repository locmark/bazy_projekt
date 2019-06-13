<h3>Wyszukaj pracownika</h3>
<?php 
    include 'scripts/show_errors.php';
    include 'scripts/db_connect.php';

    if(isset($_POST['nazwisko'])) {
        $nazwisko = $_POST['nazwisko'];
    } else {
        $nazwisko = '';
    }

    if(isset($_POST['akademik'])) {
        $akademik = $_POST['akademik'];
    } else {
        $akademik = -1;
    }

    if(isset($_POST['stanowisko'])) {
        $stanowisko = $_POST['stanowisko'];
    } else {
        $stanowisko = -1;
    }

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='nazwisko'>
        Nazwisko: <input type=text name=nazwisko value='$nazwisko'>
        <input type=submit name=Dodaj value='Wyszukaj po nazwisku'> 
        </br>
        </form>
    ";

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='akademik'>
        Akademik:
        <select name=akademik>";

    $query = "SELECT a.id, a.nazwa FROM Akademiki a";
    $result = pg_query($query);
    $liczba_wierszy = pg_num_rows($result);


    for($w =0;$w<$liczba_wierszy;$w++)
    {
        echo "<option value=";
        echo pg_fetch_result($result,$w,0);
        if (pg_fetch_result($result,$w,0) == $akademik) {
            echo " selected";
        }
        echo ">";
        echo pg_fetch_result($result,$w,1);
        echo "</option>";
    }

    echo "
        </select>
        <input type=submit name=Dodaj value='Wyszukaj po akademiku'> 
        </form>
    ";

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='stanowisko'>
        Stanowisko:
        <select name=stanowisko>";

    $query = "SELECT z.id, z.nazwa FROM zawody z";
    $result = pg_query($query);
    $liczba_wierszy = pg_num_rows($result);


    for($w =0;$w<$liczba_wierszy;$w++)
    {
        echo "<option value=";
        echo pg_fetch_result($result,$w,0);
        if (pg_fetch_result($result,$w,0) == $stanowisko) {
            echo " selected";
        }
        echo ">";
        echo pg_fetch_result($result,$w,1);
        echo "</option>";
    }

    echo "
        </select>
        <input type=submit name=Dodaj value='Wyszukaj po stanowiku'> 
        </form>
    ";


    if(isset($_POST['typ_wyszukiwania'])) {
        if($_POST['typ_wyszukiwania'] == 'nazwisko') {
            $query = "SELECT p.id, p.imie, p.nazwisko, z.nazwa AS Stanowisko FROM 
            Pracownicy p JOIN Zawody z ON p.id_zawodu = z.id
            WHERE p.nazwisko = '$nazwisko'";
        }

        if($_POST['typ_wyszukiwania'] == 'akademik') {
            $query = "SELECT p.id, p.imie, p.nazwisko, z.nazwa AS Stanowisko FROM 
            Pracownicy p JOIN Pracownicy_akademika pa ON pa.id_pracownika = p.id
            JOIN Zawody z ON p.id_zawodu = z.id
            WHERE pa.id_akademika = $akademik";
        }

        if($_POST['typ_wyszukiwania'] == 'stanowisko') {
            $query = "SELECT p.id, p.imie, p.nazwisko, z.nazwa AS Stanowisko FROM 
            Pracownicy p JOIN Zawody z ON p.id_zawodu = z.id
            WHERE p.id_zawodu = $stanowisko";
        }

        $result = pg_query($query);
        $liczba_kolumn = pg_num_fields($result);
        $liczba_wierszy = pg_num_rows($result);
        // teraz wyświetlmy dane
        echo "<TABLE border width=1>";
        echo "<TR>";
        for($k =1;$k<$liczba_kolumn;$k++)
        {
            echo "<th>";
            echo pg_field_name($result,$k);
            echo "</th>"; //echo "\t";
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
    }


    pg_close($connection);
?> 