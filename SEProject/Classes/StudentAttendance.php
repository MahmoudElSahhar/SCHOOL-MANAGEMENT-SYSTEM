<?php
class StudentAttendance extends Attendance{
    public $ID;
    public $lectureID;
    public $attendanceID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("attendance_student", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);

                parent::__construct($row['AttendanceID']);

                $result2 = $db->selectWhere("student", "UserID=".$this->userID);
                $row2 = mysqli_fetch_array($result2);

                $this->userID = new Student($row2['ID']);

                $this->ID = $row['ID'];
                $this->lectureID = $row['LectureID'];
                $this->attendanceID = $row['AttendanceID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($a){
        $fields = array("ID","LectureID","AttendanceID");
        $values = array($a->ID, $a->lectureID, $a->attendanceID);
        $db = Database::getInstance();
        $db->insert("attendance_student", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","LectureID","AttendanceID","LastUpdated");
        $values = array($a->ID, $a->lectureID, $a->attendanceID, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("attendance_student", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("attendance_student", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("attendance_student", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new StudentAttendance($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>