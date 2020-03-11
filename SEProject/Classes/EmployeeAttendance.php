<?php
class EmployeeAttendance extends Attendance{
    public $ID;
    public $attendanceTime;
    public $departureTime;
    public $attendanceID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("attendance_employee", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);

                parent::__construct($row['AttendanceID']);

                $result2 = $db->selectWhere("employee", "UserID=".$this->userID);
                $row2 = mysqli_fetch_array($result2);

                $this->userID = new Employee($row2['ID']);

                
                $this->ID = $row['ID'];
                $this->attendanceTime = $row['AttendanceTime'];
                $this->departureTime = $row['DepartureTime'];
                $this->attendanceID = $row['AttendanceID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($a){
        $fields = array("ID","AttendanceTime","DepartureTime","AttendanceID");
        $values = array($a->ID, $a->attendanceTime, $a->departureTime, $a->attendanceID);
        $db = Database::getInstance();
        $db->insert("attendance_employee", $fields, $values);
    }

    public static function update($a){
        $fields = array("ID","AttendanceTime","DepartureTime","LastUpdated");
        $values = array($a->ID, $a->attendanceTime, $a->departureTime, $a->lastUpdated);
        $db = Database::getInstance();
        $db->update("attendance_employee", $fields, $values);
    }

    public static function delete($aID){
        $db = Database::getInstance();
        $db->delete("attendance_employee", "ID =".$aID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("attendance_employee", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new EmployeeAttendance($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>