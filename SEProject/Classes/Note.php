<?php
class Note{
    public $ID;
    public $date;
    public $note;
    public $studentID;
    public $lectureScheduleID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            
            $result = $db->selectWhere("note", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->date = $row['Date'];
                $this->note = $row['Note'];
                $this->studentID = new Student($row['StudentID']);
                $this->lectureScheduleID = new LectureSchedule($row['LectureScheduleID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","Date","Note","StudentID","LectureScheduleID");
        $values = array($obj->ID, $obj->date, $obj->note, $obj->studentID, $obj->lectureScheduleID);
        $db = Database::getInstance();
        $db->insert("note", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","Date","Note","StudentID","LectureScheduleID","LastUpdated");
        $values = array($obj->ID, $obj->date, $obj->note, $obj->studentID, $obj->lectureScheduleID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("note", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("note", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("note", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Note($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>