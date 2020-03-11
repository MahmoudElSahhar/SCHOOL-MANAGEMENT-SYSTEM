<?php

class GradeTypeValueController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->GradeTypeValue->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewGradeTypeValue'])){
            header("Location: GradeTypeValue.php");
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
        $this->Facade->GradeTypeValue->subjectID = $_POST['subjectID'];
        $this->Facade->GradeTypeValue->gradeTypeID = $_POST['gradeTypeID'];
        $this->Facade->GradeTypeValue->value = $_POST['value'];
        $this->Facade->GradeTypeValue->add($this->Facade->GradeTypeValue);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->GradeTypeValue->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>