<?php

class AssignmentGradeViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        
        echo "
            <form method='post' action='' class = 'Form'>
                <h3>Assignment</h3>
                <select class = 'form-control' name='assignmentID' required>
                <option value = ''>Choose One...</option>";
        $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
        for($j=0;$j<sizeof($subject);$j++)
        {
            $Assignment = $this->Facade->Assignment->view("SubjectID=".$subject[$j]->ID);
            for($i = 0 ; $i < count($Assignment) ; $i++){
                echo "<option value='".$Assignment[$i]->ID."'>".$Assignment[$i]->ID."</option>";
            }
        }
        echo "</select>";

        echo "  <br> 
                <h3>Grade Details</h3>
                <select class = 'form-control' name='gradeDetailsID' required>
                <option value = ''>Choose One...</option>";
                $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
                for($h=0;$h<sizeof($subject);$h++)
                {
                    $Assignment = $this->Facade->Assignment->view("SubjectID=".$subject[$h]->ID);
                    for($i = 0 ; $i < count($Assignment) ; $i++){
                        $AG = $this->Facade->AssignmentGrade->view("AssignmentID=".$Assignment[$i]->ID);
                        if($AG)
                        {
                            for($j = 0 ; $j < count($AG) ; $j++){
                                echo "<option value='".$AG[$j]->gradeDetailsID->ID."'>".$AG[$j]->gradeDetailsID->ID."</option>";
                            }
                        }
                    }
                }
        echo "  </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        
        echo "
        <form method='post' action=''>
            <table id = 'tbl' class = 'table table-striped table-light'>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Student</th>
                    <th>Grade Type</th>
                    <th>Grade value</th>
                    <th>Out of</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead><tbody>";

                $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
                if($subject)
                {
                    for($j=0;$j<sizeof($subject);$j++)
                    {
                        $Assignment = $this->Facade->Assignment->view("SubjectID=".$subject[$j]->ID);
                        if($Assignment)
                        {
                            for($i = 0 ; $i < count($Assignment) ; $i++){
                                $AG = $this->Facade->AssignmentGrade->view("AssignmentID=".$Assignment[$i]->ID);
                                if($AG)
                                {
                                    for($w = 0 ; $w < count($AG) ; $w++){
                                        echo "<tr>
                                            <td>".$subject[$j]->name."</td>
                                            <td>".$AG[$w]->gradeDetailsID->studentID->fullName."</td>
                                            <td>".$AG[$w]->gradeDetailsID->gradeTypeValueID->gradeTypeID->name."</td>
                                            <td>".$AG[$w]->gradeDetailsID->gradeTypeValueID->value."</td>
                                            <td>".$AG[$w]->gradeDetailsID->gradeValue."</td>
                                            <td><button type='submit' name='e_".$AG[$w]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                            <td><button type='submit' name='d_".$AG[$w]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                        </tr>";
                                    }
                                }
                            }
                        }
                    }
                }
                
            echo "</tbody></table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAssignmentGrade'>Create Assignment Grade</button>
            </form>
            ";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>