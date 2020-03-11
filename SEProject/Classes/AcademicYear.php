<?php
class AcademicYear implements iReport{
    public $ID;
    public $academicLevelID;
    public $fees;
    public $startDate;
    public $endDate;
    public $classes; //array
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("academic_year", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->academicLevelID = new Type($row['AcademicLevelID']);
                $this->fees = $row['Fees'];
                $this->startDate = $row['StartDate'];
                $this->endDate = $row['EndDate'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }

            $result = $db->selectWhere("class", "AcademicYearID=".$ID);
            $this->classes = array();
            $i = 0;

            if($result != NULL){
                while($row = mysqli_fetch_array($result))
                {
                    $this->classes[$i] = new Classes($row['ID']);
                    $i++;
                }
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","AcademicLevelID","Fees","StartDate","EndDate");
        $values = array($obj->ID, $obj->academicLevelID, $obj->fees, $obj->startDate, $obj->endDate);
        $db = Database::getInstance();
        $db->insert("academic_year", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","AcademicLevelID","Fees","StartDate","EndDate","LastUpdated");
        $values = array($obj->ID, $obj->academicLevelID, $obj->fees, $obj->startDate, $obj->endDate, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("academic_year", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("academic_year", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("academic_year", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new AcademicYear($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public static function GenerateReport()
    {
        $db = Database::getInstance();
        $academicyearObj=new AcademicYear(0);
        $academicyear=$academicyearObj->view(1);
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
        echo "<div id='chartContainer' style='height: 370px; width: 100%;'></div>";
    }
}

?>