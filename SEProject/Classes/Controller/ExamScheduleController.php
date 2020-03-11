<?php

class ExamScheduleController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $ES = $this->Facade->ExamSchedule->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateExamSchedule'])){
            header("Location: ExamSchedule.php");
        }

        if($ES)
        {
            for($i=0;$i<sizeof($ES);$i++)
            {
                if(isset($_POST['e_'.$ES[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$ES[$i]->ID]))
                {
                    $this->delete($ES[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->ExamSchedule->subjectID = $_POST['subjectID'];
        $this->Facade->ExamSchedule->classID = $_POST['classID'];
        $this->Facade->ExamSchedule->examTypeID = $_POST['examTypeID'];
        $this->Facade->ExamSchedule->date = $_POST['date'];
        $this->Facade->ExamSchedule->startTime = $_POST['startTime'];
        $this->Facade->ExamSchedule->endTime = $_POST['endTime'];
        $this->Facade->ExamSchedule->add($this->Facade->ExamSchedule);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->ExamSchedule->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>