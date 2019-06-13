<h3>Pokoje</h3>
<?php 
    include 'scripts/show_errors.php';
    include 'scripts/db_connect.php';

    $id_akademika = $_GET['id'];

    $query = "SELECT p.id, p.nazwa FROM Pokoje p WHERE p.id_akademika = $id_akademika";
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
        echo "<TD> <a href=scripts/pokoj_usun_script.php?id=$id>Usuń</a> </TD>";
        echo "</TR>"; //echo "<br />";
    }
    echo "</TABLE>";

    pg_close($connection);

    echo "<a href=pokoj_add.php?id=$id_akademika>Dodaj Pokoj</a>  ";
?>

  