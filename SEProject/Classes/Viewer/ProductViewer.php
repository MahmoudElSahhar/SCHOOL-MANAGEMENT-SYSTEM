<?php

class ProductViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Type = $this->Facade->Type->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>cost</h3>
                <input class = 'form-control' type = 'Number' min = '0' max = '1000000'  step = 'Any' name = 'cost' placeholder = 'cost' required>
                <br>
                <h3>name</h3>
                <input class = 'form-control' type = 'Text' name = 'name' placeholder = 'name' required>
                <br>
                <h3>quantity</h3>
                <input class = 'form-control' type = 'Number' min = '0' max = '100000'  name = 'quantity' placeholder = 'quantity' required>
                <br>
                <h3>productTypeID</h3>
                <select class = 'form-control' name = 'productTypeID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Type) ; $i++)
                {
                    echo "<option value='".$Type[$i]->ID."'>".$Type[$i]->name."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Product = $this->Facade->Product->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>cost</th>
                    <th>name</th>
                    <th>quantity</th>
                    <th>productTypeID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Product)
                    {
                        for($i = 0 ; $i < count($Product) ; $i++){
                            echo "<tr>
                                <td>".$Product[$i]->cost."</td>
                                <td>".$Product[$i]->name."</td>
                                <td>".$Product[$i]->quantity."</td>
                                <td>".$Product[$i]->productTypeID->name."</td>
                                <td><button type='submit' name='e_".$Product[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Product[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateProduct'>Create Product</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>