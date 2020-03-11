<?php

class EmployeeAttendanceController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $EA = $this->Facade->EmployeeAttendance->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateEmployeeAttendance'])){
            header("Location: EmployeeAttendance.php");
        }

        if($EA)
        {
            for($i=0;$i<sizeof($EA);$i++)
            {
                if(isset($_POST['e_'.$EA[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$EA[$i]->ID]))
                {
                    $this->delete($EA[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->EmployeeAttendance->attendanceTime = $_POST['attendanceTime'];
        $this->Facade->EmployeeAttendance->departureTime = $_POST['departureTime'];
        $this->Facade->EmployeeAttendance->attendanceID = $_POST['attendanceID'];
        $this->Facade->EmployeeAttendance->add($this->Facade->EmployeeAttendance);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->EmployeeAttendance->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>