<?php
class AssignmentGrade{
    public $ID;
    public $assignmentID;
    public $gradeDetailsID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        $db = Database::getInstance();
        if($ID != 0){
            $result = $db->selectWhere("assignment_grade", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->assignmentID = new Assignment($row['AssignmentID']);
                $this->gradeDetailsID = new GradeDetails($row['GradeDetailsID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($ag){
        $fields = array("ID","AssignmentID","GradeDetailsID");
        $values = array($ag->ID, $ag->assignmentID, $ag->gradeDetailsID);
        $db = Database::getInstance();
        $db->insert("assignment_grade", $fields, $values);
    }

    public static function update($ag){
        $fields = array("ID","AssignmentID","GradeDetailsID","LastUpdated");
        $values = array($ag->ID, $ag->assignmentID, $ag->gradeDetailsID, $ag->lastUpdated);
        $db = Database::getInstance();
        $db->update("assignment_grade", $fields, $values);
    }

    public static function delete($agID){
        $db = Database::getInstance();
        $db->delete("assignment_grade", "ID =".$agID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("assignment_grade", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new AssignmentGrade($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>