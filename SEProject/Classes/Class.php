<?php
class Classes{
    public $ID;
    public $academicYearID;
    public $name;
    public $capacity;
    public $schedule; //array
    public $students; //array
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        $db = Database::getInstance();
        if($ID != 0){
            $result = $db->selectWhere("class", "ID=".$ID);
            $result2 = $db->selectWhere("class_schedule", "ClassID=".$ID);
            $result3 = $db->selectWhere("student", "ClassID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->academicYearID = $row['AcademicYearID'];
                $this->name = $row['Name'];
                $this->capacity = $row['Capacity'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
            if($result2 != NULL){
                $this->schedule = array();
                $i = 0;
                while($row2 = mysqli_fetch_array($result2))
                {
                    $this->schedule[$i] = new LectureSchedule($row2['ScheduleID']);
                    $i++;
                }
            }
            if($result3 != NULL){
                $this->students = array();
                $i = 0;
                while($row3 = mysqli_fetch_array($result3))
                {
                    $this->students[$i] = new Student($row3['ID']);
                    $i++;
                }
            }
        }
    }

    public static function add($c){
        $fields = array("ID","AcademicYearID","Name","Capacity");
        $values = array($c->ID, $c->academicYearID, $c->name, $c->capacity);
        $db = Database::getInstance();
        $db->insert("class", $fields, $values);
    }

    public static function update($c){
        $fields = array("ID","AcademicYearID","Name","Capacity","LastUpdated");
        $values = array($c->ID, $c->academicYearID, $c->name, $c->capacity, $c->lastUpdated);
        $db = Database::getInstance();
        $db->update("class", $fields, $values);
    }

    public static function delete($cID){
        $db = Database::getInstance();
        $db->delete("class", "ID =".$cID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("class", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Classes($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>