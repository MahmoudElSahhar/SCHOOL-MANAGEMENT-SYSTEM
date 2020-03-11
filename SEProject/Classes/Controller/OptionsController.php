<?php

class OptionsController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $AY = $this->Facade->Options->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewOptions'])){
            header("Location: Options.php");
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
        $this->Facade->Options->name = $this->test_input($_POST['name']);
        $this->Facade->Options->dataType = $_POST['dataTypeID'];
        $this->Facade->Options->inputType = $_POST['inputTypeID'];
        $this->Facade->Options->add($this->Facade->Options);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Options->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>