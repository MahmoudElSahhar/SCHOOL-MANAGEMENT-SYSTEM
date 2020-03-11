<!DOCTYPE html>
<html>
    <head>
        <?php
        ob_start();
        include "../../Header.php";
        include "../../Classes/Viewer/RegistrationViewer.php";
        include "../../Classes/Controller/RegistrationController.php";
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
                    <h4 class = "mt-2">StudentAffairs Portal</h4>
                </nav>
                <div class = "container-fluid">
                    <h1 class = "mt-4">CRUD Registration</h1>
                    <?php
                        unserialize($_SESSION['user'])->CRUD_Registration();
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