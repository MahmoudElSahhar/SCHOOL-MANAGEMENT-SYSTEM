<?php
class Assignment{
    public $ID;
    public $assignDate;
    public $dueDate;
    public $subjectID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("assignment", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->assignDate = $row['AssignDate'];
                $this->dueDate = $row['DueDate'];
                $this->subjectID = new Subject($row['SubjectID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($a){
        $fields = array("ID","AssignDate","DueDate","SubjectID");
        $values = array($a->ID, $a->assignDate, $a->dueDate, $a->subjectID);
        $db = Database::getInstance();
        $db->insert("assignment", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","AssignDate","DueDate","SubjectID","LastUpdated");
        $values = array($a->ID, $a->assignDate, $a->dueDate, $a->subjectID, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("assignment", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("assignment", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("assignment", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Assignment($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>