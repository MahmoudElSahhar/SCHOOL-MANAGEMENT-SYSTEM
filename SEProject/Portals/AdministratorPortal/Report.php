<!DOCTYPE html>
<html>
    <head>
        <?php
        include "../../Header.php";
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
                <div class = "container-fluid">
                    <h1 class = "mt-4">Report</h1>
                    <?php
                        $db = Database::getInstance();
                        $result = $db->selectWhere("type","Name='ReportsDropDown'");
                        
                        echo "<br>
                                <form method='post' action='' class = 'Form'>
                                    <select class = 'form-control' name = 'ReportID' required>
                                        <option value=''>Choose One...</option>";
                        
                        if($result)
                        {
                            $row = mysqli_fetch_array($result);
                            $result2 = $db->selectWhere("type","RefID=".$row['ID']);
                            
                            if($result2 != NULL)
                            {
                                while($row2 = mysqli_fetch_array($result2))
                                {
                                    echo "<option value='".$row2["Name"]."'>".$row2["Name"]."</option>";
            
                                }
                            }
                            echo "
                                    </select>
                                    <br><br>    
                                    <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
                                </form>";
                        }        
                        
                        if(isset($_POST['add']))
                        {
                            $DesiredReport=$_POST['ReportID'];
                            $obj=ReportGenerator::ReportGeneratorSelector($DesiredReport);
                            $Report=new ReportGenerator($obj);
                            $Report->DrawDesiredReport();
                        }
                    ?>
                    <br>
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