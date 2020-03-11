<?php

class MedicineViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Product = $this->Facade->Product->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>expiryDate</h3>
                <input class = 'form-control' type = 'Date' min = '".date('Y-m-d')."' name = 'expiryDate' required>
                <br>
                <h3>productID</h3>
                <select class = 'form-control' name = 'productID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Product) ; $i++)
                {
                    echo "<option value='".$Product[$i]->ID."'>".$Product[$i]->name."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $Medicine = $this->Facade->Medicine->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>expiryDate</th>
                    <th>productID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($Medicine)
                    {
                        for($i = 0 ; $i < count($Medicine) ; $i++){
                            echo "<tr>
                                <td>".$Medicine[$i]->expiryDate."</td>
                                <td>".$Medicine[$i]->productID."</td>
                                <td><button type='submit' name='e_".$Medicine[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Medicine[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateMedicine'>Create Medicine</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>