<h3>Akdemiki</h3>
<?php 
    include 'scripts/show_errors.php';
    include 'scripts/db_connect.php';

    $query = "SELECT a.id, a.nazwa, a.adres FROM Akademiki a";
    $result = pg_query($query);

    $liczba_kolumn = pg_num_fields($result);
    $liczba_wierszy = pg_num_rows($result);
    // teraz wyświetlmy dane
    echo "<TABLE>";
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
        echo "<TD> <a href=?page=widok_pokoi_akademika&id=$id>Pokoje</a> </TD>";
        echo "<TD> <a href=scripts/akademik_usun_script.php?id=$id>Usuń</a> </TD>";
        echo "</TR>"; //echo "<br />";
    }
    echo "</TABLE>";

    pg_close($connection);
?>

<a href="akademik_add.php">Dodaj Akademik</a>    