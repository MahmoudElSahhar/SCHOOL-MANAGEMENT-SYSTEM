<!DOCTYPE html>
<html>
    <head>
        <?php
        ob_start();
        include "../../Header.php";
        include "../../Classes/Viewer/BounsViewer.php";
        include "../../Classes/Controller/BounsController.php";
        ?>
    </head>
    <body>
        <div class = "d-flex" id = "wrapper">
            <div class = "border-right" id = "sidebar-wrapper">
                <div class = "list-group list-group-flush">
                    <?php
                    include "../../../SEProject/SideNavItems.php";
                    ?>
                </div>
            </div>
            <div id = "page-content-wrapper">
                <nav class = "navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <span class = "navbar-toggler-icon" id = "menu-toggle"></span>
                    <h4 class = "mt-2">Accountant Portal</h4>
                </nav>
                <div class = "container-fluid">
                    <h1 class = "mt-4">CRUD Employees Bonuses</h1>
                    <?php
                    unserialize($_SESSION['user'])->CRUD_Bouns();
                    ?>
                </div>
            </div>
        </div>

        <script>
            $("#menu-toggle").click(function(Event)
            {
                Event.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
    <?php
    include "../../Footer.php";
    ob_end_flush();
    ?>
</html>