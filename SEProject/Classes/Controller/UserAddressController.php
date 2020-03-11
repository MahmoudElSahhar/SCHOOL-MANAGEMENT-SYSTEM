<?php

class UserAddressController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $UserAddress = $this->Facade->UserAddress->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewUserAddress'])){
            header("Location: UserAddress.php");
           
        }

        if($UserAddress)
        {
            for($i=0;$i<sizeof($UserAddress);$i++)
            {
                if(isset($_POST['e_'.$UserAddress[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$UserAddress[$i]->ID]))
                {
                    $this->delete($UserAddress[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }

    }

    public function add(){
        $this->Facade->UserAddress->userID = $_POST['UserID'];
        $this->Facade->UserAddress->addressID = $_POST['AddressID'];
        $this->Facade->UserAddress->contactTypeID = $_POST['ContactTypeID'];

        $this->Facade->UserAddress->add($this->Facade->UserAddress);
        echo '<script>javascript:history.go(-2)</script>';

    }

    public function delete($ID){
        $this->Facade->UserAddress->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>