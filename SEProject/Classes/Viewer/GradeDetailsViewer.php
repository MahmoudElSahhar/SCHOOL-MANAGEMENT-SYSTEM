<?php

class GradeDetailsViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $studentID = $this->Facade->Student->view(1);
        $gradeTypeValueID = $this->Facade->GradeTypeValue->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>studentID</h3>
                <select class = 'form-control' name = 'studentID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($studentID) ; $i++)
                {
                    echo "<option value='".$studentID[$i]->ID."'>".$studentID[$i]->fullName."</option>";
                }
        echo "
                </select>
                <br>
                <h3>gradeTypeValueID</h3>
                <select class = 'form-control' name = 'gradeTypeValueID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($gradeTypeValueID) ; $i++)
                {
                    echo "<option value='".$gradeTypeValueID[$i]->ID."'>".$gradeTypeValueID[$i]->ID."</option>";
                }
        echo "
                </select>
                <br>
                <h3>gradeValue</h3>
                <input class = 'form-control' type = 'Number' min = '0' max = '100'  step = 'Any' name = 'gradeValue' placeholder = 'gradeValue' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $GD = $this->Facade->GradeDetails->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>studentID</th>
                    <th>gradeTypeValueID</th>
                    <th>gradeValue</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead><tbody>";
                    if($GD)
                    {
                        for($i = 0 ; $i < count($GD) ; $i++){
                            echo "<tr>
                                <td>".$GD[$i]->studentID->fullName."</td>
                                <td>".$GD[$i]->gradeTypeValueID->ID."</td>
                                <td>".$GD[$i]->gradeValue."</td>
                                <td><button type='submit' name='e_".$GD[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$GD[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateGradeDetails'>Create Grade Details</button>
            </form>";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        $Body = "<table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
        <tr>
        <th>Subject Name</th>
        <th>Grade Type</th>
        <th>My Grade</th>
        <th>Out Of</th>
        </tr>
        </thead><tbody>";
        
        $GradeDetails = $this->Facade->GradeDetails->view("StudentID=".unserialize($_SESSION["user"])->ID);

        if($GradeDetails != NULL){
            for($i = 0; $i < count($GradeDetails); $i++)
            {
                /*$GradeTypeValue = $this->Facade->GradeTypeValue->view("ID=".$GradeDetails[$i]->gradeTypeValueID->ID);
                
                $Subject = $this->Facade->Subject->view("ID=".$GradeTypeValue[0]->subjectID->ID);
                
                $Type = $this->Facade->Type->view("ID=".$GradeTypeValue[0]->gradeTypeID->ID);*/

                $gradeTypeValue = $GradeDetails[$i]->gradeTypeValueID;
                $subject = $gradeTypeValue->subjectID;
                $type = $gradeTypeValue->gradeTypeID;
                
                $Body = $Body."<tr>
                        <td>".$subject->name."</td>
                        <td>".$type->name."</td>
                        <td>".$GradeDetails[$i]->gradeValue."</td>
                        <td>".$gradeTypeValue->value."</td>
                    </tr>";
            }
        }
        $Body = $Body."</tbody></table>";
        echo $Body;

        echo "<script>
                $('#tbl').DataTable();
            </script>";

        echo "
        <form method = 'Post' action = ''>
            <button class = 'btn btn-primary' type = 'Submit' name = 'PDF_Generator'>Download Transcript</button>
            <br>
        </form>";

        if(isset($_POST["PDF_Generator"]))
        {
           $pdf = new PDF_Generator($Body);
           ob_end_clean();
           $pdf->Generate();
        }
    }
}
?>