<html>
    <head>
        <title>dodaj pokoj</title>
        <?php include 'scripts/head.php'; ?>
    </head>
    <body>
    <?php 
            include 'scripts/show_errors.php';
            include 'scripts/db_connect.php';

            $id = $_GET['id'];

            echo "
                <FORM action=scripts/pokoj_add_script.php method=POST>
                Dodaj nowego pracownika </br>
                <input type=hidden name=id_akademika value=$id>
                Nazwa: <input type=text name=nazwa> </br>
                Pojemnosc: <input type=text name=pojemnosc> </br>
                <input type=submit name=Dodaj value=Dodaj> 
                </form>
            ";

            pg_close($connection);
        ?>
    </body>
</html>