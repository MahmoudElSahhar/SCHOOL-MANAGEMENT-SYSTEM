<?php

class AcademicYearController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->AcademicYear->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewAcademicYear'])){
            header("Location: AcademicYear.php");
        }

        if($AY)
        {
            for($i=0;$i<sizeof($AY);$i++)
            {
                if(isset($_POST['e_'.$AY[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$AY[$i]->ID]))
                {
                    $this->delete($AY[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->AcademicYear->academicLevelID = $_POST['type'];
        $this->Facade->AcademicYear->fees = $_POST['fees'];
        $this->Facade->AcademicYear->startDate = $_POST['startDate'];
        $this->Facade->AcademicYear->endDate = $_POST['endDate'];
        $this->Facade->AcademicYear->add($this->Facade->AcademicYear);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->AcademicYear->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>