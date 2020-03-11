<?php
class LectureSchedule /*extends Schedule*/{
    public $ID;
    public $lectureID;
    public $subjectID;
    public $dayID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("schedule_lecture", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                //parent::__construct($row['ScheduleID']);
                
                $this->ID = $row['ID'];
                $this->lectureID = new Lecture($row['LectureID']);
                $this->subjectID = new Subject($row['SubjectID']);
                $this->dayID = new Day($row['DayID']);
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }

    }

    public static function add($obj){
        $fields = array("ID","LectureID","SubjectID","DayID");
        $values = array($obj->ID, $obj->lectureID, $obj->subjectID, $obj->dayID);
        $db = Database::getInstance();
        $db->insert("schedule_lecture", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","LectureID","SubjectID","DayID","LastUpdated");
        $values = array($obj->ID, $obj->lectureID, $obj->subjectID, $obj->dayID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("schedule_lecture", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("schedule_lecture", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("schedule_lecture", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new LectureSchedule($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>