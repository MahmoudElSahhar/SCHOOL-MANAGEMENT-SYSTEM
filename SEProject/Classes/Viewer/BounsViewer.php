<?php

class BounsViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $employee = $this->Facade->Employee->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Employee</h3>
                <select class = 'form-control' name='employeeID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($employee) ; $i++){
                        echo "<option value='".$employee[$i]->ID."'>".$employee[$i]->ID."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Percentage</h3>
                <input class = 'form-control' type='number' min = '0' max = '100'  step = 'Any' name='percentage' placeholder = 'percentage' required>
                <br>
                <h3>Year</h3>
                <input class = 'form-control' type='number' min = '0' max = '3000'  name='year' placeholder = 'year' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->Bouns->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Percentage</th>
                    <th>Year</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->employeeID->fullName."</td>
                                <td>".$AY[$i]->percentage."</td>
                                <td>".$AY[$i]->year."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewBouns'>Create Bouns</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>