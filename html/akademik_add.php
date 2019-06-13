<html>
    <head>
        <title>dodaj akademik</title>
        <?php include 'scripts/head.php'; ?>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            echo "
                <FORM action=scripts/akademik_add_script.php method=POST>
                Dodaj nowy akadmik </br>
                Nazwa: <input type=text name=nazwa> </br>
                Adres: <input type=text name=adres> </br>
                <input type=submit name=Dodaj value=Dodaj> 
                </form>
            ";

            pg_close($connection);
        ?>
    </body>
</html>