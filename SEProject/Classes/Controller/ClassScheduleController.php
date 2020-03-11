<?php

class ClassScheduleController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $db = Database::getInstance();
        $result = $db->selectWhere("class_schedule", 1);

        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateClassSchedule'])){
            header("Location: ClassSchedule.php");
        }

        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                if(isset($_POST['e_'.$row['ID']]))
                {

                }

                if(isset($_POST['d_'.$row['ID']]))
                {
                    $this->delete($row['ID']);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $fields = array("ClassID","ScheduleID");
        $values = array($_POST['classID'], $_POST['lectureScheduleID']);
        $db = Database::getInstance();
        $db->insert("class_schedule", $fields, $values);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $db = Database::getInstance();
        $db->delete("class_schedule", "ID =".$ID);
    }

    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>