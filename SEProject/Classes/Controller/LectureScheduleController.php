<?php

class LectureScheduleController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $LS = $this->Facade->LectureSchedule->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateLectureSchedule'])){
            header("Location: LectureSchedule.php");
        }

        if($LS)
        {
            for($i=0;$i<sizeof($LS);$i++)
            {
                if(isset($_POST['e_'.$LS[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$LS[$i]->ID]))
                {
                    $this->delete($LS[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->LectureSchedule->lectureID = $_POST['lectureID'];
        $this->Facade->LectureSchedule->subjectID = $_POST['subjectID'];
        $this->Facade->LectureSchedule->dayID = $_POST['dayID'];
        $this->Facade->LectureSchedule->add($this->Facade->LectureSchedule);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->LectureSchedule->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>