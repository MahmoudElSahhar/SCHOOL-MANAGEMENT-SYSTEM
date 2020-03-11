<?php

class AddressController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){
        $arr = $this->Facade->Address->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewAddress'])){
            header("Location: Address.php");
        }

        if($arr)
        {
            for($i = 0 ; $i < count($arr) ; $i++){
                if(isset($_POST['e_'.$arr[$i]->ID])){
        
                }
                if(isset($_POST['d_'.$arr[$i]->ID])){
                    $this->delete($arr[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Address->addressName = $this->test_input($_POST['addressName']);
        $this->Facade->Address->refID = $_POST['refID'];
        $this->Facade->Address->add($this->Facade->Address);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Address->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>