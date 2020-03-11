<?php

class RegistrationViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $student = $this->Facade->Student->view(1);
        $academicYears = $this->Facade->AcademicYear->view(1);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Student</h3>
                <select class = 'form-control' name='student' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($student) ; $i++){
                        echo "<option value='".$student[$i]->ID."'>".$student[$i]->fullName."</option>";
                    } 
        echo "</select>
        <br>
        <h3>Academic Year</h3>
                <select class = 'form-control' name='academicyear' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($academicYears) ; $i++){
                        echo "<option value='".$academicYears[$i]->ID."'>".$academicYears[$i]->ID."</option>";
                    }
        echo " 
            </select>
            <br><br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $arr = $this->Facade->Registration->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>AcademicYear</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($arr)
                    {
                        for($i = 0 ; $i < count($arr) ; $i++){
                            echo "<tr>
                                <td>".((new Student($arr[$i]->studentID))->fullName)."</td>
                                <td>".$arr[$i]->academicYearID."</td>
                                <td><button type='submit' name='e_".$arr[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$arr[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
        echo "</tbody>
        </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewRegistration'>Create Registration</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>