<?php
class Student extends User{
    public $ID;
    public $classID;
    public $mailAddress;
    public $userID;
    public $creationDate;
    public $lastUpdated;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("student", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                parent::__construct($row['UserID']);

                $this->ID = $row['ID'];
                $this->classID = $row['ClassID'];
                $this->mailAddress = $row['MailAddress'];
                $this->userID = $row['UserID'];
                $this->creationDate = $row['CreationDate'];
                $this->lastUpdated = $row['LastUpdated'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("ID","ClassID","MailAddress","UserID");
        $values = array($obj->ID, $obj->classID, $obj->mailAddress, $obj->userID);
        $db = Database::getInstance();
        $db->insert("student", $fields, $values);
    }

    public static function update($obj){
        $obj->lastUpdated = "NOW()";
        $fields = array("ID","ClassID","MailAddress","UserID","LastUpdated");
        $values = array($obj->ID, $obj->classID, $obj->mailAddress, $obj->userID, $obj->lastUpdated);
        $db = Database::getInstance();
        $db->update("student", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("student", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("student", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Student($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public function viewClass(){
        $Viewer = new ClassViewer();
        $Viewer->viewWhere();
    }

    public function viewAssignment(){
        $Viewer = new AssignmentViewer();
        $Viewer->viewWhere();
    }
    
    public function viewFees(){
        $Viewer = new FeesViewer();
        $Viewer->viewWhere();
    }
    
    public function viewGrades(){
        $Viewer = new GradeDetailsViewer();
        $Viewer->viewWhere();
    }

    public function viewSchedule(){
        $Viewer = new LectureScheduleViewer();
        $Viewer->viewWhere();
    }

    public function viewSubject(){
        $Viewer = new SubjectViewer();
        $Viewer->viewWhere();
    }

    public function viewTeacherNotes(){
        $Viewer = new NoteViewer();
        $Viewer->viewWhere();
    }
}

?>