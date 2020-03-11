<?php

class ExamScheduleViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Subject = $this->Facade->Subject->view(1);
        $Class = $this->Facade->Class->view(1);
        $getTypeID = $this->Facade->Type->view("Name='Exam Type'");
        $Type = $this->Facade->Type->view("RefID=".$getTypeID[0]->ID);

        echo "
            <form method='post' action='' class = 'Form'>
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
                <h3>Class</h3>
                <select class = 'form-control' name = 'classID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Class) ; $i++)
                {
                    echo "<option value='".$Class[$i]->ID."'>".$Class[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>Exam Type</h3>
                <select class = 'form-control' name = 'examTypeID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Type) ; $i++)
                {
                    echo "<option value='".$Type[$i]->ID."'>".$Type[$i]->name."</option>";
                }
        echo "
                </select>
                <br>
                <h3>Date</h3>
                <input class = 'form-control' type = 'Date' min = '".date('Y-m-d')."' name = 'date' required>";
        echo "
                </select>
                <br>
                <h3>Start Time</h3>
                <input class = 'form-control' type = 'Time' min = '".date("H:i")."' name = 'startTime' required>
                <br>
                <h3>End Time</h3>
                <input class = 'form-control' type = 'Time' min = '".date("H:i")."' name = 'endTime' required>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $ES = $this->Facade->ExamSchedule->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($ES)
                    {
                        for($i = 0 ; $i < count($ES) ; $i++){
                            echo "<tr>
                                <td>".$ES[$i]->subjectID->name."</td>
                                <td>".$ES[$i]->classID->name."</td>
                                <td>".$ES[$i]->examTypeID->name."</td>
                                <td>".$ES[$i]->date."</td>
                                <td>".$ES[$i]->startTime."</td>
                                <td>".$ES[$i]->endTime."</td>
                                <td><button type='submit' name='e_".$ES[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$ES[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateExamSchedule'>Create Exam Schedule</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>