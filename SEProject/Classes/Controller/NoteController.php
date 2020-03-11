<?php

class NoteController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Note = $this->Facade->Note->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateNote'])){
            header("Location: Note.php");
        }

        if($Note)
        {
            for($i=0;$i<sizeof($Note);$i++)
            {
                if(isset($_POST['e_'.$Note[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Note[$i]->ID]))
                {
                    $this->delete($Note[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Note->date = $_POST['date'];
        $this->Facade->Note->note = $this->test_input($_POST['note']);
        $this->Facade->Note->studentID = $_POST['studentID'];
        $this->Facade->Note->lectureScheduleID = $_POST['lectureScheduleID'];
        $this->Facade->Note->add($this->Facade->Note);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Note->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>