<?php

class ScheduleController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Schedule = $this->Facade->Schedule->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateSchedule'])){
            header("Location: Schedule.php");
        }

        if($Schedule)
        {
            for($i=0;$i<sizeof($Schedule);$i++)
            {
                if(isset($_POST['e_'.$Schedule[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Schedule[$i]->ID]))
                {
                    $this->delete($Schedule[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Schedule->dayID = $_POST['dayID'];
        $this->Facade->Schedule->add($this->Facade->Schedule);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Schedule->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>