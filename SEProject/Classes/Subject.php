<?php
class Subject{
    public $ID;
    public $name;
    public $academicYearID;
    public $teacherID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("subject", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->academicYearID = $row['AcademicYearID'];
                $this->teacherID = new Employee($row['TeacherID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }

    }

    public static function add($obj){
        $fields = array("ID","Name","AcademicYearID","TeacherID");
        $values = array($obj->ID, $obj->name, $obj->academicYearID, $obj->teacherID);
        $db = Database::getInstance();
        $db->insert("subject", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Name","AcademicYearID","TeacherID","LastUpdated");
        $values = array($obj->ID, $obj->name, $obj->academicYearID, $obj->teacherID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("subject", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("subject", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("subject", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Subject($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>