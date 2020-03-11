<?php

class AssignmentGradeController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){
        $arr = $this->Facade->AssignmentGrade->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewAssignmentGrade'])){
            header("Location: AssignmentGrade.php");
        }

        if($arr)
        {
            for($i = 0 ; $i < count($arr) ; $i++){
                if(isset($_POST['e_'.$arr[$i]->ID])){
        
                }
                if(isset($_POST['d_'.$arr[$i]->ID])){
                    $this->delete($arr[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->AssignmentGrade->assignmentID = $_POST['assignmentID'];
        $this->Facade->AssignmentGrade->gradeDetailsID = $_POST['gradeDetailsID'];
        $this->Facade->AssignmentGrade->add($this->Facade->AssignmentGrade);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->AssignmentGrade->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>