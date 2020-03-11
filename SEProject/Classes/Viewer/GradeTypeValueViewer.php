<?php

class GradeTypeValueViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Subject = $this->Facade->Subject->view(1);
        $type = $this->Facade->Type->view("Name='Grade Type'");
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Subject ID</h3>
                <select class = 'form-control' name='subjectID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($Subject) ; $i++){
                        echo "<option value='".$Subject[$i]->ID."'>".$Subject[$i]->name."</option>";
                    }
        echo "  </select>
        <br>
        <h3>Grade Type Value</h3>
                <select class = 'form-control' name='gradeTypeID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($type) ; $i++){
                        echo "<option value='".$type[$i]->ID."'>".$type[$i]->name."</option>";
                    }
        echo "  </select>
                <br>
                <h3>Value</h3>
                <input class = 'form-control' type='text' name='value' placeholder = 'value' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $GTV = $this->Facade->GradeTypeValue->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Subject ID</th>
                    <th>GradeType</th>
                    <th>Value</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead><tbody>";
                    if($GTV)
                    {
                        for($i = 0 ; $i < count($GTV) ; $i++){
                            echo "<tr>
                                <td>".$GTV[$i]->subjectID->name."</td>
                                <td>".$GTV[$i]->gradeTypeID->ID."</td>
                                <td>".$GTV[$i]->value."</td>
                                <td><button type='submit' name='e_".$GTV[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$GTV[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewGradeTypeValue'>Create Grade Type Value</button>
            </form>";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>