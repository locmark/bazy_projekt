<h3>Wyszukaj studenta</h3>
<?php 
    include 'scripts/show_errors.php';
    include 'scripts/db_connect.php';

    if(isset($_POST['nazwisko'])) {
        $nazwisko = $_POST['nazwisko'];
    } else {
        $nazwisko = '';
    }

    if(isset($_POST['pokoj'])) {
        $pokoj = $_POST['pokoj'];
    } else {
        $pokoj = -1;
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
        <input type=hidden name=typ_wyszukiwania value='pokoj'>
        Pokój:
        <select name=pokoj>";

    $query = "SELECT p.id, p.nazwa, a.nazwa FROM Akademiki a, Pokoje p WHERE a.id = p.id_akademika";
    $result = pg_query($query);
    $liczba_wierszy = pg_num_rows($result);


    for($w =0;$w<$liczba_wierszy;$w++)
    {
        echo "<option value=";
        echo pg_fetch_result($result,$w,0);
        if (pg_fetch_result($result,$w,0) == $pokoj) {
            echo " selected";
        }
        echo ">";
        echo pg_fetch_result($result,$w,2);
        echo " - ";
        echo pg_fetch_result($result,$w,1);
        echo "</option>";
    }

    echo "
        </select>
        <input type=submit name=Dodaj value='Wyszukaj po pokoju'> 
        </form>
    ";


    if(isset($_POST['typ_wyszukiwania'])) {
        if($_POST['typ_wyszukiwania'] == 'nazwisko') {
            $query = "SELECT s.id, s.imie, s.nazwisko, s.rok_studiow, p.nazwa AS pokoj, a.nazwa AS DS FROM 
            Studenci s JOIN Pokoje p ON s.id_pokoju = p.id
            JOIN Akademiki a ON a.id = p.id_akademika 
            WHERE s.nazwisko = '$nazwisko'";
        }

        if($_POST['typ_wyszukiwania'] == 'pokoj') {
            $query = "SELECT s.id, s.imie, s.nazwisko, s.rok_studiow, p.nazwa AS pokoj, a.nazwa AS DS FROM 
            Studenci s JOIN Pokoje p ON s.id_pokoju = p.id
            JOIN Akademiki a ON a.id = p.id_akademika 
            WHERE s.id_pokoju = $pokoj";
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
            echo "<TD> <a href=student_komputery.php?id=$id>Komputery</a> </TD>";
            echo "<TD> <a href=student_edycja.php?id=$id>Edycja</a> </TD>";
            echo "<TD> <a href=scripts/student_usun_script.php?id=$id>Usuń</a> </TD>";
            echo "</TR>"; //echo "<br />";
        }
        echo "</TABLE>";
    }


    // $query = "SELECT * FROM Studenci_pokoje_akademiki";
    // $result = pg_query($query);

    // $liczba_kolumn = pg_num_fields($result);
    // $liczba_wierszy = pg_num_rows($result);
    // // teraz wyświetlmy dane
    // echo "<TABLE border width=1>";
    // echo "<TR>";
    // for($k =1;$k<$liczba_kolumn;$k++)
    // {
    //     echo "<TD>";
    //     echo pg_field_name($result,$k);
    //     echo "</TD>"; //echo "\t";
    // }
    // echo "</TR>";

    // for($w =0;$w<$liczba_wierszy;$w++)
    // {
    //     echo "<TR>";
    //     for($k =1;$k<$liczba_kolumn;$k++)
    //     {$query = "SELECT * FROM Studenci_pokoje_akademiki";
    //         $result = pg_query($query);
    //         echo "<TD>";
    //         echo pg_fetch_result($result,$w,$k);
    //         echo "</TD>"; //echo "\t";
    //     }
    //     $id = pg_fetch_result($result,$w,0);
    //     echo "<TD> <a href=student_komputery.php?id=$id>Komputery</a> </TD>";
    //     echo "<TD> <a href=student_edycja.php?id=$id>Edycja</a> </TD>";
    //     echo "<TD> <a href=scripts/student_usun_script.php?id=$id>Usuń</a> </TD>";
    //     echo "</TR>"; //echo "<br />";
    // }
    // echo "</TABLE>";

    pg_close($connection);
?> 