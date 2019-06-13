<html>
    <head>
        <title>bazy - projekt</title>
        <?php include 'scripts/head.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'main';
        }

        echo "<a href=?page=widok_wyszukaj_studentow><div class=button> Wyszukaj studentów </div></a>";
        echo "<a href=?page=widok_wyszukaj_komputer><div class=button> Wyszukaj komputer </div></a>";
        echo "<a href=?page=widok_wyszukaj_pracownikow><div class=button> Wyszukaj pracowników</div></a>";
        echo "<a href=?page=widok_studentow_wszystkich><div class=button> Pokaż wszystkich studentów </div></a>";
        echo "<a href=?page=widok_pracownicy_wszyscy><div class=button> Pokaż wszystkich pracowników </div></a>";
        echo "<a href=?page=widok_akademikow_wszystkich><div class=button> Zarządzaj strukturą akademików </div></a>";
        
        
        $page_to_show = $page.".php";

        include($page_to_show);

        ?>

        <div style="display: inline-block; vertical-align: text-top;">
            

        </div>

        

        <div style="display: inline-block; vertical-align: text-top;">


        </div>
    </body>
</html>