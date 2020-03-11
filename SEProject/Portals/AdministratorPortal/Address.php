<!DOCTYPE html>
<html>
    <head>
        <?php
        include "../../Header.php";
        include "../../Classes/Viewer/AddressViewer.php";
        include "../../Classes/Controller/AddressController.php";
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
                    <h4 class = "mt-2">Administrator Portal</h4>
                </nav>

                <br>

                <div class = "container-fluid">
                    <div class = "col-md-10 offset-sm-1">
                        <div class = "card border-primary">
                            <div class = "card-header bg-primary"><h2>Address</h2></div>
                            <div class = "card-body">
                            <?php
                            $Viewer = new AddressViewer();
                            $Controller = new AddressController();
                            
                            $Viewer->viewAddForm();

                            $Controller->check();
                            ?>
                            </div>
                        </div>
                    </div>
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
    ?>
</html>