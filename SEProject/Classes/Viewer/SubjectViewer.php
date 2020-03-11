<?php

class SubjectViewer
{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm()
    {
        $Subjects = $this->Facade->Subject->view(1);
        $AY = $this->Facade->AcademicYear->view(1);

        $condition1 = "Name='Teacher'";
        $TYPES = $this->Facade->Type->view($condition1);

        $condition2 = "UserTypeID=".$TYPES[0]->ID;
        $Users = $this->Facade->User->view($condition2);
            echo"
            <form method='post' action='' class = 'Form'>
                    <h3>Name</h3>
                    <input class = 'form-control' type='text' name='Name' placeholder = 'Name' required>
                    <br>
                    <h3>AcademicYearID</h3>
                    <select class = 'form-control' name='AcademicYearID' required>
                    <option value = ''>Choose One...</option>";
                        for($i = 0 ; $i < count($AY) ; $i++)
                        {
                            echo "<option value='".$AY[$i]->ID."'>".$AY[$i]->ID."</option>";
                        }
            echo "</select> 
            <br>";
            echo "<h3>TeacherID</h3>
            <select class = 'form-control' name='TeacherID' required>
            <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($Users) ; $i++)
                    {
                        echo "<option value='".$Users[$i]->ID."'>".$Users[$i]->fullName."</option>";
                    }
            echo "</select>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
                </form>";
    }

    public function viewInTable()
    {
        $Subject = $this->Facade->Subject->view(1);
        echo "
                <form method='post' action=''>
                    <table id = 'tbl' class = 'table table-striped table-light'>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>AcademicYearID</th>
                        <th>TeacherID</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>";
                        if($Subject)
                        {
                            for($i = 0 ; $i < count($Subject) ; $i++)
                            {
                                echo"<tr>
                                    <td>".$Subject[$i]->name."</td>
                                    <td>".$Subject[$i]->academicYearID."</td>
                                    <td>".$Subject[$i]->teacherID->fullName."</td>
                                    <td><button type='submit' name='e_".$Subject[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                    <td><button type='submit' name='d_".$Subject[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                                    </tr>";

                            }
                        }
            echo "</tbody>
            </table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewSubject'>Create Subject</button>
        </form>
    ";
    echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        $Class = $this->Facade->Class->view("ID=".unserialize($_SESSION["user"])->classID);
        $schedule = $Class[0]->schedule;
        
        //$Subject = $this->Facade->Subject->view("AcademicYearID=".$Class[0]->academicYearID);

        $Body = "<table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
            <tr>
            <th>Name</th>
            <th>AcademicYearID</th>
            <th>Teacher Name</th>
            </tr>
        </thead><tbody>";

        for($i=0;$i<sizeof($schedule);$i++)
        {
            $subject = $schedule[$i]->subjectID;
            $Body = $Body."<tr>
                <td>".$subject->name."</td>
                <td>".$subject->academicYearID."</td>
                <td>".$subject->teacherID->fullName."</td>
                </tr>";
        }

        $Body = $Body."</tbody></table>";
        echo $Body;

        echo "<script>
                $('#tbl').DataTable();
            </script>";

        echo "
        <form method = 'Post' action = ''>
            <button class = 'btn btn-primary' type = 'Submit' name = 'PDF_Generator'>Download Subjects</button>
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