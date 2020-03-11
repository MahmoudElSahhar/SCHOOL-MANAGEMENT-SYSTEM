<?php

class LectureController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Lecture = $this->Facade->Lecture->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewLecture'])){
            header("Location: Lecture.php");
        }

        if($Lecture)
        {
            for($i=0;$i<sizeof($Lecture);$i++)
            {
                if(isset($_POST['e_'.$Lecture[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Lecture[$i]->ID]))
                {
                    $this->delete($Lecture[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Lecture->name = $this->test_input($_POST['name']);
        $this->Facade->Lecture->startTime = $_POST['startTime'];
        $this->Facade->Lecture->endTime = $_POST['endTime'];
        $this->Facade->Lecture->add($this->Facade->Lecture);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Lecture->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>