<?php
class Registration{
    public $ID;
    public $studentID;
    public $academicYearID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("registration", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->studentID = $row['StudentID'];
                $this->academicYearID = $row['AcademicYearID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","StudentID","AcademicYearID");
        $values = array($obj->ID, $obj->studentID, $obj->academicYearID);
        $db = Database::getInstance();
        $db->insert("registration", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","StudentID","AcademicYearID","LastUpdated");
        $values = array($obj->ID, $obj->studentID, $obj->academicYearID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("registration", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("registration", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("registration", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Registration($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>