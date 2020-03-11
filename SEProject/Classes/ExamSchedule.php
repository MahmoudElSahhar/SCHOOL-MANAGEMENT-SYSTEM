<?php
class ExamSchedule extends Schedule{
    public $ID;
    public $subjectID;
    public $classID;
    public $examTypeID;
    public $date;
    public $startTime;
    public $endTime;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("schedule_exam", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                //parent::__construct($row['ScheduleID']);
                
                $this->ID = $row['ID'];
                $this->subjectID = new Subject($row['SubjectID']);
                $this->classID = new Classes($row['ClassID']);
                $this->examTypeID = new Type($row['ExamTypeID']);
                $this->startTime = $row['StartTime'];
                $this->endTime = $row['EndTime'];
                $this->date = $row['Date'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }

    }

    public static function add($obj){
        $fields = array("ID","SubjectID","ClassID","ExamTypeID","StartTime","EndTime","Date");
        $values = array($obj->ID, $obj->subjectID, $obj->classID, $obj->examTypeID, $obj->startTime, $obj->endTime, $obj->date);
        $db = Database::getInstance();
        $db->insert("schedule_exam", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","SubjectID","ClassID","ExamTypeID","StartTime","EndTime","Date","LastUpdated");
        $values = array($obj->ID, $obj->subjectID, $obj->classID, $obj->examTypeID, $obj->startTime, $obj->endTime, $obj->date, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("schedule_exam", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("schedule_exam", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("schedule_exam", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new ExamSchedule($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>