<?php

class PaidSalaryViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $employees = $this->Facade->Employee->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Employee</h3>
                <select class = 'form-control' name='employee' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($employees) ; $i++){
                        echo "<option value='".$employees[$i]->ID."'>".$employees[$i]->fullName."</option>";
                    }
        echo "</select>
        <br>
        <h3>Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='date' required>
                <br>
                <h3>Salary</h3>
                <input class = 'form-control' type='number' min = '0' max = '100000' name='salary' placeholder = 'salary' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $arr = $this->Facade->PaidSalary->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Salary</th>
                        <th>Creation Date</th>
                        <th>Last Update</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($arr)
                    {
                        for($i = 0 ; $i < count($arr) ; $i++){
                            echo "<tr>
                                <td>".$arr[$i]->employeeID->fullName."</td>
                                <td>".$arr[$i]->date."</td>
                                <td>".$arr[$i]->salary."</td>
                                <td>".$arr[$i]->creationDate."</td>
                                <td>".$arr[$i]->lastUpdated."</td>
                                <td><button type='submit' name='e_".$arr[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$arr[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
        echo "</tbody>
        </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewPaidSalary'>Create Paid Salary</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>