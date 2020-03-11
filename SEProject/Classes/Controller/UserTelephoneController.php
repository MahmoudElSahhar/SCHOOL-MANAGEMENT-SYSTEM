<?php

class UserTelephoneController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $UserTele = $this->Facade->UserTelephone->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewTelephone'])){
            header("Location: UserTelephone.php");

        }
        if($UserTele)
        {
            for($i=0;$i<sizeof($UserTele);$i++)
            {
                if(isset($_POST['e_'.$UserTele[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$UserTele[$i]->ID]))
                {
                    $this->delete($UserTele[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->UserTelephone->userID = $_POST['UserID'];
        $this->Facade->UserTelephone->telephone = $_POST['Telephone'];
        $this->Facade->UserTelephone->contactTypeID = $_POST['ContactTypeID'];

        $this->Facade->UserTelephone->add($this->Facade->UserTelephone);
        echo '<script>javascript:history.go(-2)</script>';

    }

    public function delete($ID){
        $this->Facade->UserTelephone->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>