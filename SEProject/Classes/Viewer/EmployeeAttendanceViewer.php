<?php

class EmployeeAttendanceViewer{
    public $Facade;

    public function __construct(){
        $this->Facade = new Facade();
    }

    public function viewAddForm(){
        $Attendance = $this->Facade->Attendance->view(1);

        echo "
            <form method='post' action='' class = 'Form'>
                <h3>attendanceTime</h3>
                <input class = 'form-control' type = 'Time' min = '".date("H:i")."' name = 'attendanceTime' required>
                <br>
                <h3>departureTime</h3>
                <input class = 'form-control' type = 'Time' min = '".date("H:i")."' name = 'departureTime' required>
                <br>
                <h3>attendanceID</h3>
                <select class = 'form-control' name = 'attendanceID' required>
                <option value = ''>Choose One...</option>";
                for($i = 0 ; $i < count($Attendance) ; $i++)
                {
                    echo "<option value='".$Attendance[$i]->ID."'>".$Attendance[$i]->ID."</option>";
                }
        echo "
                </select>
                <br><br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'add'>Submit</button>
            </form>
        ";
    }

    public function viewInTable(){
        $EA = $this->Facade->EmployeeAttendance->view(1);
        echo "
            <form method='post' action=''>
                <table id = 'tbl' class = 'table table-striped table-light'>
                <thead>
                <tr>
                    <th>attendanceTime</th>
                    <th>departureTime</th>
                    <th>attendanceID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if($EA)
                    {
                        for($i = 0 ; $i < count($EA) ; $i++){
                            echo "<tr>
                                <td>".$EA[$i]->attendanceTime."</td>
                                <td>".$EA[$i]->departureTime."</td>
                                <td>".$EA[$i]->attendanceID."</td>
                                <td><button type='submit' name='e_".$EA[$i]->ID."'><i class = 'fa fa-pencil' aria-hidden = 'true'></i></button></td>
                                <td><button type='submit' name='d_".$EA[$i]->ID."'><i class = 'fa fa-trash-o' aria-hidden = 'true'></i></button></td>
                            </tr>";
                        }
                    }
                echo "</tbody>
                </table>
                <br>
                <button class = 'btn btn-primary' type = 'Submit' name = 'CreateEmployeeAttendance'>Create Employee Attendance</button>
            </form>
        ";
        echo "<script>
                $('#tbl').DataTable();
            </script>";
    }

}

?>