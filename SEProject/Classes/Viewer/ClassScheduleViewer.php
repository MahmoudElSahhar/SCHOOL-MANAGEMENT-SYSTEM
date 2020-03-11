<?php

class ClassScheduleViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $db = Database::getInstance();
        $result = $db->selectWhere("class", 1);
        $row = mysqli_fetch_array($result);

        $result2 = $db->selectWhere("schedule_lecture", 1);
        $row2 = mysqli_fetch_array($result2);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>Class</h3>
                <select class = 'form-control' name = 'classID' required>
                <option>Choose One...</option>";
                if($result)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row['ID']."'>".$row['Name']."</option>";
                    }
                }
        echo "
                </select>
                <br>
                <h3>Schedule</h3>
                <select class = 'form-control' name = 'lectureScheduleID' required>
                <option>Choose One...</option>";
                if($result2)
                {
                    while($row2 = mysqli_fetch_array($result2))
                    {
                        $dayResult = $db->selectWhere("day", "ID=".$row2['DayID']);
                        $dayRow = mysqli_fetch_array($dayResult);
                        $lectureResult = $db->selectWhere("lecture", "ID=".$row2['LectureID']);
                        $lectureRow = mysqli_fetch_array($lectureResult);
                        $subjectResult = $db->selectWhere("subject", "ID=".$row2['SubjectID']);
                        $subjectRow = mysqli_fetch_array($subjectResult);

                        echo "<option value='".$row2['ID']."'>".$lectureRow['Name']." is ".$subjectRow['Name']." on ".$dayRow['Name']."</option>";
                    }
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>";
    }

    public function viewInTable(){
        $db = Database::getInstance();
        $result = $db->selectWhere("class_schedule", 1);

        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                    <tr>
                    <th>Class</th>
                    <th>Lecture</th>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead><tbody>";
                    if($result)
                    {
                        while($row = mysqli_fetch_array($result)){
                            $class = new Classes($row['ClassID']);
                            $LS = new LectureSchedule($row['ScheduleID']);
                            echo "<tr>
                                <td>".$class->name."</td>
                                <td>".$LS->lectureID->name."</td>
                                <td>".$LS->subjectID->name."</td>
                                <td>".$LS->dayID->name."</td>
                                <td><button type='submit' name='e_".$row['ID']."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$row['ID']."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody></table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateClassSchedule'>Create ClassSchedule</button>
                <br>
            </form>";

            echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>