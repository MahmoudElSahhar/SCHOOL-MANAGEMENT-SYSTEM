<?php

class OrdersViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Registration = $this->Facade->Registration->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>orderCost</h3>
                <input class = 'form-control' type = 'Number' min = '0' max = '1000000'  step = 'Any' name = 'orderCost' placeholder = 'orderCost' required>
                <br>
                <h3>requestDate</h3>
                <input class = 'form-control' type = 'Date' min = '".date('Y-m-d')."' name = 'requestDate' required>
                <br>
                <h3>arrivalDate</h3>
                <input class = 'form-control' type = 'Date' min = '".date('Y-m-d')."' name = 'arrivalDate' required>
                <br>
                <h3>received</h3>
                <select class = 'form-control' name = 'received' required>
                <option value = ''>Choose One...</option>
                <option value = '1'>Yes</option>
                <option value = '0'>No</option>
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Orders = $this->Facade->Orders->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>orderCost</th>
                    <th>requestDate</th>
                    <th>arrivalDate</th>
                    <th>received</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Orders)
                    {
                        for($i = 0 ; $i < count($Orders) ; $i++){
                            echo "<tr>
                                <td>".$Orders[$i]->orderCost."</td>
                                <td>".$Orders[$i]->requestDate."</td>
                                <td>".$Orders[$i]->arrivalDate."</td>
                                <td>".$Orders[$i]->received."</td>
                                <td><button type='submit' name='e_".$Orders[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Orders[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateOrders'>Create Orders</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>