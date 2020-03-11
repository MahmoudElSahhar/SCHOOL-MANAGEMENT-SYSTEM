<?php

class ClassController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->Class->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewClass'])){
            header("Location: Class.php");
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
        $this->Facade->Class->academicYearID = $_POST['academicYearID'];
        $this->Facade->Class->name = $this->test_input($_POST['name']);
        $this->Facade->Class->capacity = $_POST['capacity'];
        $this->Facade->Class->add($this->Facade->Class);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Class->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>