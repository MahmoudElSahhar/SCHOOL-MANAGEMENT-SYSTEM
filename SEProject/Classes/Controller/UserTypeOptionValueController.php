<?php

class UserTypeOptionValueController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $UserTypeOptionValue = $this->Facade->UserTypeOptionValue->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewValue'])){
            header("Location: UserTypeOptionValue.php");

        }
        if($UserTypeOptionValue)
        {
            for($i=0;$i<sizeof($UserTypeOptionValue);$i++)
            {
                if(isset($_POST['e_'.$UserTypeOptionValue[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$UserTypeOptionValue[$i]->ID]))
                {
                    $this->delete($UserTypeOptionValue[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->UserTypeOptionValue->userTypeOptionID = $_POST['userTypeOptionID'];
        $this->Facade->UserTypeOptionValue->value = $_POST['Value'];
        $this->Facade->UserTypeOptionValue->userID = $_POST['UserID'];

        $this->Facade->UserTypeOptionValue->add($this->Facade->UserTypeOptionValue);
        echo '<script>javascript:history.go(-2)</script>';

    }

    public function delete($ID){
        $this->Facade->UserTypeOptionValue->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>