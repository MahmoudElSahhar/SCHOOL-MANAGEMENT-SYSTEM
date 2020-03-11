<?php

class OrderDetailsViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $products = $this->Facade->Product->view(1);
        $orders = $this->Facade->Orders->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Product</h3>
                <select class = 'form-control' name='product' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($products) ; $i++){
                        echo "<option value='".$products[$i]->ID."'>".$products[$i]->name."</option>";
                    }
        echo "  </select>
        <br>
        <h3>Quantity</h3>
                <input class = 'form-control' type='number' min = '0' max = '100000'  name='quantity' placeholder = 'quantity' required>
                <br>
                <h3>OrderID</h3>
                <select class = 'form-control' name='order' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($orders) ; $i++){
                        echo "<option value='".$orders[$i]->ID."'>".$orders[$i]->ID."</option>";
                    }
        echo "  </select>
        <br> 
        <h3>TotalCost</h3>
                <input class = 'form-control' type='number' min = '0' max = '1000000'  step = 'Any' name='totalcost' placeholder = 'totalcost' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $arr = $this->Facade->OrderDetails->view(1);
        echo "
        <form method='post' action=''>
            <table id = 'tbl' class = 'table table-striped table-light'>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>OrderID</th>
                    <th>TotalCost</th>
                    <th>Creation Date</th>
                    <th>Last Update</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>";
                if($arr)
                {
                    for($i = 0 ; $i < count($arr) ; $i++){
                        echo "<tr>
                            <td>".$arr[$i]->productID->name."</td>
                            <td>".$arr[$i]->quantity."</td>
                            <td>".$arr[$i]->orderID->ID."</td>
                            <td>".$arr[$i]->totalCost."</td>
                            <td>".$arr[$i]->creationDate."</td>
                            <td>".$arr[$i]->lastUpdated."</td>
                            <td><button type='submit' name='e_".$arr[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                            <td><button type='submit' name='d_".$arr[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            <td><button type='submit' name='download_".$arr[$i]->ID."'><i class = 'fa fa-download' aria-hidden = 'true'></i></button></td>
                        </tr>";
                    }
                }
            echo "<tbody>
            </table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewOrderDetails'>Create Order Details</button>
            </form>
            ";
            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>