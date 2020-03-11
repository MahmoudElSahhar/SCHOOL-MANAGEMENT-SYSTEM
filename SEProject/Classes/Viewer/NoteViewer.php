<?php

class NoteViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>date</h3>
                <input class = 'form-control' type = 'Date' min = '".date('Y-m-d')."' name = 'date' required>
                <br>
                <h3>note</h3>
                <textarea class = 'form-control' name = 'note' placeholder = 'note' required></textarea>
                <br>
                <h3>studentID</h3>
                <select class = 'form-control' name = 'studentID' required>
                <option value = ''>Choose One...</option>";
                
                $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
                for($j = 0 ; $j < sizeof($subject) ; $j++)
                {
                    $LS = $this->Facade->LectureSchedule->view("SubjectID=".$subject[$j]->ID);
                    if($LS)
                    {
                        for($i = 0 ; $i < count($LS) ; $i++)
                        {
                            $class = $this->Facade->Class->view(1);
                            if($class)
                            {
                                for($s = 0 ; $s < count($class) ; $s++)
                                {
                                    $schedule = $class[$s]->schedule;
                                    if($schedule)
                                    {
                                        for($r = 0 ; $r < sizeof($schedule) ; $r++)
                                        {
                                            if($class[$s]->schedule[$r]->ID == $LS[$i]->ID)
                                            {
                                                echo "class-schedule: ".$class[$s]->schedule[$r]->ID."  LS: ".$LS[$i]->ID."<br>";
                                                for($q=0;$q<sizeof($class[$s]->students);$q++)
                                                {
                                                    echo "<option value='".$class[$s]->students[$q]->ID."'>".$class[$s]->students[$q]->fullName."</option>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                echo "</select>";
                
        echo "  <br>
                <h3>lectureScheduleID</h3>
                <select class = 'form-control' name = 'lectureScheduleID' required>
                <option value = ''>Choose One...</option>";
                $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
                for($j = 0 ; $j < sizeof($subject) ; $j++)
                {
                    $LS = $this->Facade->LectureSchedule->view("SubjectID=".$subject[$j]->ID);
                    if($LS)
                    {
                        for($i = 0 ; $i < count($LS) ; $i++)
                        {
                            echo "<option value='".$LS[$i]->ID."'>".$LS[$i]->subjectID->name."</option>";
                        }
                    }
                }
        echo "
                </select>
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
                    <th>Date</th>
                    <th>Note</th>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead><tbody>";

        $subject = $this->Facade->Subject->view("TeacherID=".unserialize($_SESSION["user"])->ID);
        for($j = 0 ; $j < sizeof($subject) ; $j++)
        {
            $LS = $this->Facade->LectureSchedule->view("SubjectID=".$subject[$j]->ID);
            if($LS)
            {
                for($i = 0 ; $i < count($LS) ; $i++)
                {
                    $Note = $this->Facade->Note->view("LectureScheduleID=".$LS[$i]->ID);
                    if($Note)
                    {
                        for($w = 0 ; $w < count($Note) ; $w++){
                            echo "<tr>
                                <td>".$Note[$w]->date."</td>
                                <td>".$Note[$w]->note."</td>
                                <td>".$Note[$w]->studentID->fullName."</td>
                                <td>".$Note[$w]->lectureScheduleID->subjectID->name."</td>
                                <td><button type='submit' name='e_".$Note[$w]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$Note[$w]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                }
            }
        }

                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateNote'>Create Note</button>
            </form>";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

    public function viewWhere(){
        $note = $this->Facade->Note->view("StudentID=".unserialize($_SESSION["user"])->ID);

        echo "<table id = 'tbl' class = 'table table-striped table-light'>
        <thead>
            <tr>
            <th>Date</th>
            <th>Subject</th>
            <th>Note</th>
            </tr>
        </thead><tbody>";

        if($note != NULL){
            for($i=0;$i<sizeof($note);$i++)
            {
                $schedule = $note[$i]->lectureScheduleID;
                echo "<tr>
                    <td>".$note[$i]->date."</td>
                    <td>".$schedule->subjectID->name."</td>
                    <td>".$note[$i]->note."</td>
                </tr>";
            }
        }
        
        echo "</tbody></table>";

        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>