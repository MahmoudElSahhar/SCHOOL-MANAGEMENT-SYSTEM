<?php

class AssignmentViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
        echo "
            <form method='post' action='' class = 'Form'>
            <h3>Subject</h3>
                <select class = 'form-control' name='subjectID' required>
                <option value = ''>Choose One...</option>";
                    for($i = 0 ; $i < count($subject) ; $i++){
                        echo "<option value='".$subject[$i]->ID."'>".$subject[$i]->name."</option>";
                    }
        echo "  </select>
        <br> 
        <h3>Assign Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='assignDate' required>
                <br>
                <h3>Due Date</h3>
                <input class = 'form-control' type='date' min = '".date('Y-m-d')."' name='dueDate' required>
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
                    <th>Assign Date</th>
                    <th>Due Date</th>
                    <th>subjectID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead><tbody>";

        $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
        for($j=0;$j<sizeof($subject);$j++)
        {
            $Assignment = $this->Facade->Assignment->view("SubjectID=".$subject[$j]->ID);
            if($Assignment)
            {
                for($i = 0 ; $i < count($Assignment) ; $i++){
                    echo "<tr>
                        <td>".$Assignment[$i]->assignDate."</td>
                        <td>".$Assignment[$i]->dueDate."</td>
                        <td>".$Assignment[$i]->subjectID->name."</td>
                        <td><button type='submit' name='e_".$Assignment[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                        <td><button type='submit' name='d_".$Assignment[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                    </tr>";
                }
            }
        }

            echo "</tbody></table>
            <br>
            <button class = 'btn btn-primary' type = 'Submit' name = 'AddNewAssignment'>Create Assignment</button>
            </form>
            ";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        echo "
        <table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
            <tr>
            <th>Assign Date</th>
            <th>Due Date</th>
            <th>Subject Name</th>
            </tr>
        </thead><tbody>";
        
        $Class = $this->Facade->Class->view("ID=".unserialize($_SESSION["user"])->classID);
        $schedule = $Class[0]->schedule;

        for($i=0;$i<sizeof($schedule);$i++)
        {
            $subject = $schedule[$i]->subjectID;
            $assignment = $this->Facade->Assignment->view("SubjectID=".$subject->ID);
            if($assignment != NULL)
            {
                for($j=0;$j<sizeof($assignment);$j++)
                {
                    echo "<tr>
                        <td>".$assignment[$j]->assignDate."</td>
                        <td>".$assignment[$j]->dueDate."</td>
                        <td>".$subject->name."</td>
                    </tr>";
                }
            }
        }
        echo "
        </tbody></table>";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }
}

?>