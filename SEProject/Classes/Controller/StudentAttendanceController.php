<?php

class StudentAttendanceController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $StudentAttendance = $this->Facade->StudentAttendance->view(1);
        if(isset($_POST['add'])){
            $this->add();

        }

        if(isset($_POST['AddNewAttendance'])){
            header("Location: StudentAttendance.php");
        }
        
        if($StudentAttendance)
        {
            for($i=0;$i<sizeof($StudentAttendance);$i++)
            {
                if(isset($_POST['e_'.$StudentAttendance[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$StudentAttendance[$i]->ID]))
                {
                    $this->delete($StudentAttendance[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->StudentAttendance->lectureID = $_POST['LectureID'];
        $this->Facade->StudentAttendance->attendanceID = $_POST['AttendanceID'];
        $this->Facade->StudentAttendance->add($this->Facade->StudentAttendance);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->StudentAttendance->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>