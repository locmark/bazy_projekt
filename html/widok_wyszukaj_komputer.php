<h3>Wyszukaj komputer</h3>
<?php 
    include 'scripts/show_errors.php';
    include 'scripts/db_connect.php';

    if(isset($_POST['host'])) {
        $host = $_POST['host'];
    } else {
        $host = '';
    }

    if(isset($_POST['IP'])) {
        $IP = $_POST['IP'];
    } else {
        $IP = '';
    }

    if(isset($_POST['MAC'])) {
        $MAC = $_POST['MAC'];
    } else {
        $MAC = '';
    }

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='host'>
        Host: <input type=text name=host value='$host'>
        <input type=submit name=Dodaj value='Wyszukaj po nazwie hosta'> 
        </br>
        </form>
    ";

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='IP'>
        IP: <input type=text name=IP value='$IP'>
        <input type=submit name=Dodaj value='Wyszukaj po adresie IP'> 
        </br>
        </form>
    ";

    echo "
        <FORM method=POST>
        <input type=hidden name=typ_wyszukiwania value='MAC'>
        MAC: <input type=text name=MAC value='$MAC'>
        <input type=submit name=Dodaj value='Wyszukaj po adresie MAC'> 
        </br>
        </form>
    ";



    if(isset($_POST['typ_wyszukiwania'])) {
        if($_POST['typ_wyszukiwania'] == 'host') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.host = '$host'";
        }

        if($_POST['typ_wyszukiwania'] == 'IP') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.IP = '$IP'";
        }

        if($_POST['typ_wyszukiwania'] == 'MAC') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.MAC = '$MAC'";
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
                if($k == 4){
                    $id_studenta = pg_fetch_result($result,$w,0);
                    echo "<a href=student_edycja.php?id=$id_studenta>";
                    echo pg_fetch_result($result,$w,$k);
                    echo "</a>";
                } else {
                    echo pg_fetch_result($result,$w,$k);
                }
                
                echo "</TD>"; //echo "\t";
            }
            $host = pg_fetch_result($result,$w,1);
            echo "<TD> aktywny </TD>";
            echo "<TD> <a href=komputer_edycja.php?host=$host>Edycja</a> </TD>";
            echo "<TD> <a href=scripts/komputer_usun_script.php?host=$host>Usuń</a> </TD>";
            echo "</TR>"; //echo "<br />";
        }

        if($_POST['typ_wyszukiwania'] == 'host') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery_archiwum k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.host = '$host'";
        }

        if($_POST['typ_wyszukiwania'] == 'IP') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery_archiwum k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.IP = '$IP'";
        }

        if($_POST['typ_wyszukiwania'] == 'MAC') {
            $query = "SELECT s.id, k.host, k.IP, k.MAC, s.imie||' '||s.nazwisko AS student FROM 
            Komputery_archiwum k JOIN Studenci s ON s.id = k.id_studenta
            WHERE k.MAC = '$MAC'";
        }

        $result = pg_query($query);
        $liczba_kolumn = pg_num_fields($result);
        $liczba_wierszy = pg_num_rows($result);

        for($w =0;$w<$liczba_wierszy;$w++)
        {
            echo "<TR>";
            for($k =1;$k<$liczba_kolumn;$k++)
            {
                echo "<TD>";
                if($k == 4){
                    $id_studenta = pg_fetch_result($result,$w,0);
                    echo "<a href=student_edycja.php?id=$id_studenta>";
                    echo pg_fetch_result($result,$w,$k);
                    echo "</a>";
                } else {
                    echo pg_fetch_result($result,$w,$k);
                }
                
                echo "</TD>"; //echo "\t";
            }
            $host = pg_fetch_result($result,$w,1);
            echo "<TD> nieaktywny </TD>";
            echo "<TD> <a href=komputer_edycja.php?host=$host>Edycja</a> </TD>";
            echo "<TD> <a href=scripts/komputer_usun_script.php?host=$host>Usuń</a> </TD>";
            echo "</TR>"; //echo "<br />";
        }

        echo "</TABLE>";
    }

    pg_close($connection);
?> 