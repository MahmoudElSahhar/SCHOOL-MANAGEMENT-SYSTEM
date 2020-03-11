<?php

class MedicineController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Medicine = $this->Facade->Medicine->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateMedicine'])){
            header("Location: Medicine.php");
        }

        if($Medicine)
        {
            for($i=0;$i<sizeof($Medicine);$i++)
            {
                if(isset($_POST['e_'.$Medicine[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Medicine[$i]->ID]))
                {
                    $this->delete($Medicine[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Medicine->expiryDate = $_POST['expiryDate'];
        $this->Facade->Medicine->productID = $_POST['productID'];
        $this->Facade->Medicine->add($this->Facade->Medicine);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Medicine->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>