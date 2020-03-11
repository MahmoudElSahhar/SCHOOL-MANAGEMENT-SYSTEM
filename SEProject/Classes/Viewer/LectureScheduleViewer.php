<?php

class LectureScheduleViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Lecture = $this->Facade->Lecture->view(1);
        $Subject = $this->Facade->Subject->view(1);
        $day = $this->Facade->Day->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>Lecture</h3>
                <select class = 'form-control' name = 'lectureID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Lecture) ; $i++)
                {
                    echo "<option value='".$Lecture[$i]->ID."'>".$Lecture[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>Subject</h3>
                <select class = 'form-control' name = 'subjectID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Subject) ; $i++)
                {
                    echo "<option value='".$Subject[$i]->ID."'>".$Subject[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>Day</h3>
                <select class = 'form-control' name = 'dayID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($day) ; $i++)
                {
                    echo "<option value='".$day[$i]->ID."'>".$day[$i]->name."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $LS = $this->Facade->LectureSchedule->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Lecture</th>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($LS)
                    {
                        for($i = 0 ; $i < count($LS) ; $i++){
                            echo "<tr>
                                <td>".$LS[$i]->lectureID->name."</td>
                                <td>".$LS[$i]->subjectID->name."</td>
                                <td>".$LS[$i]->dayID->name."</td>
                                <td><button type='submit' name='e_".$LS[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$LS[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateLectureSchedule'>Create Lecture Schedule</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        $Body = "<table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
            <tr>
            <th>Time</th>
            <th>Day</th>
            <th>Subject</th>
            </tr>
        </thead><tbody>";
        
        $Class = $this->Facade->Class->view("ID=".unserialize($_SESSION["user"])->classID);
        $schedule = $Class[0]->schedule;

        for($i=0;$i<sizeof($schedule);$i++)
        {
            $lecture = $schedule[$i]->lectureID;
            $day = $schedule[$i]->dayID;
            $subject = $schedule[$i]->subjectID;
            $Body = $Body."<tr>
                <td>".$lecture->name." ".$lecture->startTime." - ".$lecture->endTime."</td>
                <td>".$day->name."</td>
                <td>".$subject->name."</td>
            </tr>";
        }
        $Body = $Body."</tbody></table>";
        echo $Body;

        echo "<script>
                $('#tbl').DataTable();
            </script>";

        echo "
        <form method = 'Post' action = ''>
            <button class = 'btn btn-primary' type = 'Submit' name = 'PDF_Generator'>Download Schedule</button>
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