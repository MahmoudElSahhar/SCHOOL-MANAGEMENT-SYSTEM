<?php
class GradeDetails{
    public $ID;
    public $studentID;
    public $gradeTypeValueID;
    public $gradeValue;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("grade_details", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->studentID = new Student($row['StudentID']);
                $this->gradeTypeValueID = new GradeTypeValue($row['GradeTypeValueID']);
                $this->gradeValue = $row['GradeValue'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($a){
        $fields = array("ID","StudentID","GradeTypeValueID","GradeValue");
        $values = array($a->ID, $a->studentID, $a->gradeTypeValueID, $a->gradeValue);
        $db = Database::getInstance();
        $db->insert("grade_details", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","StudentID","GradeTypeValueID","GradeValue","LastUpdated");
        $values = array($a->ID, $a->studentID, $a->gradeTypeValueID, $a->gradeValue, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("grade_details", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("grade_details", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("grade_details", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new GradeDetails($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>