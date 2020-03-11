<?php

class OrderDetailsController{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function check(){
        $arr = $this->Facade->OrderDetails->view(1);
        if(isset($_POST['add'])){
            $this->add();
        }

        if(isset($_POST['AddNewOrderDetails'])){
            header("Location: OrderDetails.php");
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
                if(isset($_POST['download_'.$arr[$i]->ID])){
                    $type = $this->Facade->Type;
                    $type->putOrderID($arr[$i]->ID);
                    $type->putTaxes();
                    $type->putDiscount();

                    $body = $type->refObj->productID->name;
                    $body = $body."<br>".$type->refObj->quantity;
                    $body = $body."<br>".$type->refObj->totalCost;
                    $body = $body."<br>".$type->TempProductID->name;
                    $body = $body.$type->description;

                    $pdf = new PDF_Generator($body);
                    ob_end_clean();
                    $pdf->Generate();
                }
            }
        }
    }

    public function add(){
        $this->Facade->OrderDetails->productID = $_POST['product'];
        $this->Facade->OrderDetails->quantity = $_POST['quantity'];
        $this->Facade->OrderDetails->orderID = $_POST['order'];
        $this->Facade->OrderDetails->totalCost = $_POST['totalcost'];
        $this->Facade->OrderDetails->add($this->Facade->OrderDetails);
        echo '<script>javascript:history.go(-2)</script>';
    }

    public function delete($ID){
        $this->Facade->OrderDetails->delete($ID);
    }
    
    function test_input($data) {
        //$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>