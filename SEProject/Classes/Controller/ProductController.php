<?php

class ProductController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Product = $this->Facade->Product->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateProduct'])){
            header("Location: Product.php");
        }

        if($Product)
        {
            for($i=0;$i<sizeof($Product);$i++)
            {
                if(isset($_POST['e_'.$Product[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Product[$i]->ID]))
                {
                    $this->delete($Product[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Product->cost = $_POST['cost'];
        $this->Facade->Product->name = $this->test_input($_POST['name']);
        $this->Facade->Product->quantity = $_POST['quantity'];
        $this->Facade->Product->productTypeID = $_POST['productTypeID'];
        $this->Facade->Product->add($this->Facade->Product);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Product->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>