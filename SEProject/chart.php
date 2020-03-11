<!DOCTYPE HTML>
<html>
    <body>
        <?php
        include "Header.php";

        $Facade = new Facade();
        $db = Database::getInstance();
        $academicyear = $Facade->AcademicYear->view(1);

        echo '<script type="text/javascript">
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
        title:{
        text: "Classes Report"
        },
        data: [
        {
        type: "column",
        dataPoints: [';
        for($i = 0; $i < count($academicyear); $i++)
        {
            $result = $db->Count("class", "AcademicYearID=".$academicyear[$i]->ID);
            if($result != NULL)
            {
                $row = mysqli_fetch_assoc($result);
            }
            echo '{label: "'.$academicyear[$i]->ID.'",  y: '.$row["Count(*)"].'},';
        }
        echo ']
        }
        ]
        });
        chart.render();
        }
        </script>';
        ?>
        <div id="chartContainer" class = "Chart"></div>
        <?php
        include "Footer.php";
        ?>
    </body>
</html>