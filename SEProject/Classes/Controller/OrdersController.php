<?php

class OrdersController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){

        $Orders = $this->Facade->Orders->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['CreateOrders'])){
            header("Location: Orders.php");
        }

        if($Orders)
        {
            for($i=0;$i<sizeof($Orders);$i++)
            {
                if(isset($_POST['e_'.$Orders[$i]->ID]))
                {

                }

                if(isset($_POST['d_'.$Orders[$i]->ID]))
                {
                    $this->delete($Orders[$i]->ID);
                    echo '<script>javascript:history.go(-1)</script>';
                }
            }
        }
    }

    public function add(){
        $this->Facade->Orders->orderCost = $_POST['orderCost'];
        $this->Facade->Orders->requestDate = $_POST['requestDate'];
        $this->Facade->Orders->arrivalDate = $_POST['arrivalDate'];
        $this->Facade->Orders->received = $_POST['received'];
        $this->Facade->Orders->add($this->Facade->Orders);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->Orders->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>