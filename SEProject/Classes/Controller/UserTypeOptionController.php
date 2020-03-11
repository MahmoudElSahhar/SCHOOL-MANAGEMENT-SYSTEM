<?php

class UserTypeOptionController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Useroptions = $this->Facade->UserTypeOption->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewUserTypeOption'])){
            header("Location: UserTypeOption.php");

        }
        if($Useroptions)
        {
            for($i=0;$i<sizeof($Useroptions);$i++)
            {
                if(isset($_POST['e_'.$Useroptions[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Useroptions[$i]->ID]))
                {
                    $this->delete($Useroptions[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->UserTypeOption->userTypeID = $_POST['UserTypeID'];
        $this->Facade->UserTypeOption->optionID = $_POST['OptionID'];

        $this->Facade->UserTypeOption->add($this->Facade->UserTypeOption);
        echo '<script>javascript:history.go(-2)</script>';

    }

    public function delete($ID){
        $this->Facade->UserTypeOption->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>