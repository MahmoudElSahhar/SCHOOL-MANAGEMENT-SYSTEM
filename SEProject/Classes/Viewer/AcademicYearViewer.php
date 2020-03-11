<?php

class AcademicYearViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $getTypeID = $this->Facade->Type->view("Name='Academic Level'");
        $type = $this->Facade->Type->view("RefID=".$getTypeID[0]->ID);
        echo "
            <form method='post' action='' class = 'Form'>
                <h3>Academic Level</h3>
                <select class = 'form-control' name='type' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($type) ; $i++){
                        echo "<option value='".$type[$i]->ID."'>".$type[$i]->name."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Fees</h3>
                <input class = 'form-control' type='Number' min = '0' max = '100000'  name='fees' placeholder = 'fees' required>
                <br>
                <h3>Start Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='startDate' required>
                <br>
                <h3>End Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='endDate' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $AY = $this->Facade->AcademicYear->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Academic Level</th>
                    <th>Fees</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($AY)
                    {
                        for($i = 0 ; $i < count($AY) ; $i++){
                            echo "<tr>
                                <td>".$AY[$i]->academicLevelID->name."</td>
                                <td>".$AY[$i]->fees."</td>
                                <td>".$AY[$i]->startDate."</td>
                                <td>".$AY[$i]->endDate."</td>
                                <td><button type='submit' name='e_".$AY[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$AY[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAcademicYear'>Create Academic Year</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>