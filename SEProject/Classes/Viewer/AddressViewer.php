<?php

class AddressViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $address = $this->Facade->Address->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
                <h3>Address Details</h3>
                <input class = 'form-control' type='text' name='addressName' placeholder = 'addressName' required>
                <br>
                <h3>Root Address</h3>
                <select class = 'form-control' name='refID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($address) ; $i++){
                        echo "<option value='".$address[$i]->ID."'>".$address[$i]->addressName."</option>";
                    } 
        echo "  </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $address = $this->Facade->Address->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Address Details</th>
                    <th>Root Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";
                    if($address)
                    {
                        for($i = 0 ; $i < count($address) ; $i++){
                            echo "<tr>
                            <td>".$address[$i]->addressName."</td>";
                            if($address[$i]->refID)
                            {
                                echo "<td>".$address[$i]->refID->addressName."</td>";
                            }
                            else
                            {
                                echo "<td></td>";
                            }
                            echo "<td><button type='submit' name='e_".$address[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                            <td><button type='submit' name='d_".$address[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
        echo "  </tbody></table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAddress'>Create Address</button>
            </form>
            ";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>