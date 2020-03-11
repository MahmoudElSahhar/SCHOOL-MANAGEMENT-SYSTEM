<?php

class TypeController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $TYPES = $this->Facade->Type->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewType'])){
            header("Location: Type.php");

        }
        if($TYPES)
        {
            for($i=0;$i<sizeof($TYPES);$i++)
            {
                if(isset($_POST['e_'.$TYPES[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$TYPES[$i]->ID]))
                {
                    $this->delete($TYPES[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->Type->name = $this->test_input($_POST['Name']);
        $this->Facade->Type->refID = $_POST['RefID'];

        $this->Facade->Type->add($this->Facade->Type);
        echo '<script>javascript:history.go(-2)</script>';

    }

    public function delete($ID){
        $this->Facade->Type->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>