<?php

class FeesController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Fees = $this->Facade->Fees->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateFees'])){
            header("Location: Fees.php");
        }

        if($Fees)
        {
            for($i=0;$i<sizeof($Fees);$i++)
            {
                if(isset($_POST['e_'.$Fees[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Fees[$i]->ID]))
                {
                    $this->delete($Fees[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Fees->value = $_POST['value'];
        $this->Facade->Fees->registrationID = $_POST['registrationID'];
        $this->Facade->Fees->add($this->Facade->Fees);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Fees->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>