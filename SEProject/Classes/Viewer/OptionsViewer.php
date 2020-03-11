<?php

class OptionsViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $dataType_Root = $this->Facade->Type->view("Name='DataType'");
        $inputType_Root = $this->Facade->Type->view("Name='InputType'");

        $dataType = $this->Facade->Type->view("RefID=".$dataType_Root[0]->ID);
        $inputType = $this->Facade->Type->view("RefID=".$inputType_Root[0]->ID);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Data Type</h3>
                <select class = 'form-control' name='dataTypeID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($dataType) ; $i++){
                        echo "<option value='".$dataType[$i]->ID."'>".$dataType[$i]->name."</option>";
                    }
        echo "  </select>
        <br>
        <h3>Input Type</h3>
                <select class = 'form-control' name='inputTypeID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($inputType) ; $i++){
                        echo "<option value='".$inputType[$i]->ID."'>".$inputType[$i]->name."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Name</h3>
                <input class = 'form-control' type='text' name='name' placeholder = 'name' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->Options->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                    <thead>
                    <tr>
                    <th>Data Type</th>
                    <th>Input Type</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead><tbody>";

                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->dataType->name."</td>
                                <td>".$AY[$i]->inputType->name."</td>
                                <td>".$AY[$i]->name."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewOptions'>Create Options</button>
            </form>
        ";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>