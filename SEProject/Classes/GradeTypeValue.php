<?php
class GradeTypeValue{
    public $ID;
    public $gradeTypeID;
    public $subjectID;
    public $value;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("grade_type_value", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->gradeTypeID = new Type($row['GradeTypeID']);
                $this->value = $row['Value'];
                $this->subjectID = new Subject($row['SubjectID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($g){
        $fields = array("ID","GradeTypeID","Value","SubjectID");
        $values = array($g->ID, $g->gradeTypeID, $g->value, $g->subjectID);
        $db = Database::getInstance();
        $db->insert("grade_type_value", $fields, $values);
    }

    public static function update($g){
        $fields = array("ID","GradeTypeID","Value","SubjectID","LastUpdated");
        $values = array($g->ID, $g->gradeTypeID, $g->value, $g->subjectID, $g->lastUpdated);
        $db = Database::getInstance();
        $db->update("grade_type_value", $fields, $values);
    }

    public static function delete($gID){
        $db = Database::getInstance();
        $db->delete("grade_type_value", "ID =".$gID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("grade_type_value", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new GradeTypeValue($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>