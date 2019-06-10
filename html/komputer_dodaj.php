<html>
    <head>
        <title>dodaj komputer</title>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $id = $_GET['id'];

            echo "
                <FORM action=scripts/komputer_add_script.php method=POST>
                Dodaj nowy komputer </br>
                <input type=hidden name=id value = $id>
                Host: <input type=text name=host> </br>
                IP: <input type=text name=IP> </br>
                MAC: <input type=text name=MAC> </br>
                <input type=submit name=Dodaj value=Dodaj> 
                </form>
            ";

            pg_close($connection);
        ?>
    </body>
</html>