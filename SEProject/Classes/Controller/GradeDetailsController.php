<?php

class GradeDetailsController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $GD = $this->Facade->GradeDetails->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateGradeDetails'])){
            header("Location: GradeDetails.php");
        }

        if($GD)
        {
            for($i=0;$i<sizeof($GD);$i++)
            {
                if(isset($_POST['e_'.$GD[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$GD[$i]->ID]))
                {
                    $this->delete($GD[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->GradeDetails->studentID = $_POST['studentID'];
        $this->Facade->GradeDetails->gradeTypeValueID = $_POST['gradeTypeValueID'];
        $this->Facade->GradeDetails->gradeValue = $_POST['gradeValue'];
        $this->Facade->GradeDetails->add($this->Facade->GradeDetails);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->GradeDetails->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>