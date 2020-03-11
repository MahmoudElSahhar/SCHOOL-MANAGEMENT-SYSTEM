<?php

class SubjectController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $subject = $this->Facade->Subject->view(1);
        if(isset($_POST['add'])){
            $this->add();

        }

        if(isset($_POST['AddNewSubject'])){
            header("Location: Subject.php");
        }

        if($subject)
        {
            for($i=0;$i<sizeof($subject);$i++)
            {
                if(isset($_POST['e_'.$subject[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$subject[$i]->ID]))
                {
                    $this->delete($subject[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->Subject->name = $this->test_input($_POST['Name']);
        $this->Facade->Subject->academicYearID = $_POST['AcademicYearID'];
        $this->Facade->Subject->teacherID = $_POST['TeacherID'];
        $this->Facade->Subject->add($this->Facade->Subject);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Subject->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>